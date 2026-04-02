<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\AdminNewQuoteNotificationMail;
use App\Mail\QuoteRequestReceivedMail;
use App\Models\Product;
use App\Models\QuoteItem;
use App\Models\QuoteRequest;
use App\Models\QuoteStatusHistory;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class QuoteListController extends Controller
{
    public function index(Request $request): View
    {
        $items = $this->detailedItems($request);

        return view('public.quote-list.index', [
            'items' => $items,
            'totalItems' => count($items),
            'prefill' => [
                'name' => $request->user()?->name,
                'email' => $request->user()?->email,
                'phone' => $request->user()?->phone,
                'company_name' => $request->user()?->companyProfile?->company_name,
                'tax_number' => $request->user()?->companyProfile?->tax_number,
            ],
        ]);
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $quantity = max(1, (int) $request->integer('quantity', 1));
        $items = $this->rawItems($request);
        $existing = $items[$product->id] ?? null;

        $items[$product->id] = [
            'product_id' => $product->id,
            'quantity' => $existing ? $existing['quantity'] + $quantity : $quantity,
        ];

        $request->session()->put('quote_list', $items);

        return back()->with('status', 'Urun teklif listenize eklendi.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:9999'],
        ]);

        $items = $this->rawItems($request);

        if (isset($items[$product->id])) {
            $items[$product->id]['quantity'] = (int) $validated['quantity'];
            $request->session()->put('quote_list', $items);
        }

        return back()->with('status', 'Teklif listeniz guncellendi.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $items = $this->rawItems($request);
        unset($items[$product->id]);
        $request->session()->put('quote_list', $items);

        return back()->with('status', 'Urun teklif listenizden cikarildi.');
    }

    public function submit(Request $request): RedirectResponse
    {
        $items = $this->detailedItems($request);

        if ($items === []) {
            return redirect()->route('quote-list.index')->withErrors([
                'quote_list' => 'Teklif gonderebilmek icin en az bir urun eklemelisiniz.',
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'tax_number' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        $quoteRequest = DB::transaction(function () use ($request, $validated, $items) {
            $quoteRequest = QuoteRequest::create([
                'quote_no' => 'TKT-'.now()->format('Ymd').'-'.Str::upper(Str::random(5)),
                'customer_user_id' => $request->user()?->id,
                'status' => 'new',
                'requester_name' => $validated['name'],
                'requester_email' => $validated['email'],
                'requester_phone' => $validated['phone'] ?? null,
                'company_name' => $validated['company_name'] ?? null,
                'tax_number' => $validated['tax_number'] ?? null,
                'note' => $validated['note'] ?? null,
                'submitted_at' => now(),
            ]);

            foreach ($items as $item) {
                QuoteItem::create([
                    'quote_request_id' => $quoteRequest->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'product_code' => $item['product']->code,
                    'quantity' => $item['quantity'],
                ]);
            }

            QuoteStatusHistory::create([
                'quote_request_id' => $quoteRequest->id,
                'user_id' => $request->user()?->id,
                'from_status' => null,
                'to_status' => 'new',
                'note' => 'Public teklif formu uzerinden olusturuldu.',
            ]);

            ActivityLogger::log('quote.request.created', $quoteRequest, [
                'quote_no' => $quoteRequest->quote_no,
                'item_count' => count($items),
            ], $request->user()?->id, $request, 'quote');

            return $quoteRequest;
        });

        Mail::to($quoteRequest->requester_email)->queue(new QuoteRequestReceivedMail($quoteRequest));
        Mail::to(env('ADMIN_NOTIFICATION_EMAIL', 'admin@bilyam.test'))->queue(new AdminNewQuoteNotificationMail($quoteRequest));

        $request->session()->forget('quote_list');

        return redirect()->route('quote-list.index')->with('status', 'Teklif talebiniz alindi. Operasyon ekibimiz kisa surede sizinle iletisime gececek.');
    }

    private function rawItems(Request $request): array
    {
        return $request->session()->get('quote_list', []);
    }

    private function detailedItems(Request $request): array
    {
        $items = collect($this->rawItems($request));

        if ($items->isEmpty()) {
            return [];
        }

        $products = Product::query()
            ->with(['category', 'brand', 'images'])
            ->whereIn('id', $items->pluck('product_id'))
            ->get()
            ->keyBy('id');

        return $items
            ->map(function (array $item) use ($products) {
                $product = $products->get($item['product_id']);

                if (! $product) {
                    return null;
                }

                return [
                    'product' => $product,
                    'quantity' => (int) $item['quantity'],
                ];
            })
            ->filter()
            ->values()
            ->all();
    }
}
