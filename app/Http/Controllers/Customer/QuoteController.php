<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $quoteNo = trim((string) $request->string('quote_no'));
        $from = $request->string('from')->toString();
        $to = $request->string('to')->toString();

        $quotes = QuoteRequest::query()
            ->withCount('items')
            ->where('customer_user_id', $request->user()->id)
            ->when($status, fn (Builder $query) => $query->where('status', $status))
            ->when($quoteNo, fn (Builder $query) => $query->where('quote_no', 'like', "%{$quoteNo}%"))
            ->when($from, fn (Builder $query) => $query->whereDate('submitted_at', '>=', $from))
            ->when($to, fn (Builder $query) => $query->whereDate('submitted_at', '<=', $to))
            ->latest('submitted_at')
            ->paginate(10)
            ->withQueryString();

        return view('customer.quotes.index', [
            'quotes' => $quotes,
            'filters' => compact('status', 'quoteNo', 'from', 'to'),
            'statuses' => $this->statuses(),
        ]);
    }

    public function show(Request $request, QuoteRequest $quote): View
    {
        abort_unless($quote->customer_user_id === $request->user()->id, 403);

        $quote->load([
            'items.product',
            'items.responseItem',
            'statusHistories.user',
        ]);

        return view('customer.quotes.show', [
            'quote' => $quote,
        ]);
    }

    public function reorder(Request $request, QuoteRequest $quote): RedirectResponse
    {
        abort_unless($quote->customer_user_id === $request->user()->id, 403);

        $quote->load('items.product');

        $items = [];

        foreach ($quote->items as $item) {
            if (! $item->product) {
                continue;
            }

            $items[$item->product->id] = [
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
            ];
        }

        $request->session()->put('quote_list', $items);

        return redirect()->route('quote-list.index')->with('status', 'Seçili teklif kalemleri yeni teklif listenize aktarıldı.');
    }

    private function statuses(): array
    {
        return [
            'new' => 'Yeni',
            'in_review' => 'İnceleniyor',
            'responded' => 'Cevaplandi',
            'closed' => 'Kapatildi',
        ];
    }
}
