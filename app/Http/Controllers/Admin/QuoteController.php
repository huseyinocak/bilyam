<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\QuoteRespondedMail;
use App\Models\QuoteItem;
use App\Models\QuoteRequest;
use App\Models\QuoteResponseItem;
use App\Models\QuoteStatusHistory;
use App\Support\ActivityLogger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $company = trim((string) $request->string('company'));
        $from = $request->string('from')->toString();
        $to = $request->string('to')->toString();

        $quotes = QuoteRequest::query()
            ->withCount('items')
            ->when($status, fn (Builder $query) => $query->where('status', $status))
            ->when($company, fn (Builder $query) => $query->where('company_name', 'like', "%{$company}%"))
            ->when($from, fn (Builder $query) => $query->whereDate('submitted_at', '>=', $from))
            ->when($to, fn (Builder $query) => $query->whereDate('submitted_at', '<=', $to))
            ->latest('submitted_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.quotes.index', [
            'quotes' => $quotes,
            'filters' => compact('status', 'company', 'from', 'to'),
            'statuses' => $this->statuses(),
        ]);
    }

    public function show(QuoteRequest $quote): View
    {
        $quote->load([
            'customer',
            'items.product',
            'items.responseItem',
            'statusHistories.user',
        ]);

        return view('admin.quotes.show', [
            'quote' => $quote,
            'statuses' => $this->statuses(),
        ]);
    }

    public function updateItem(Request $request, QuoteRequest $quote, QuoteItem $item): RedirectResponse
    {
        abort_unless($item->quote_request_id === $quote->id, 404);

        $validated = $request->validate([
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'lead_time' => ['nullable', 'string', 'max:255'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        QuoteResponseItem::updateOrCreate(
            ['quote_item_id' => $item->id],
            [
                'unit_price' => $validated['unit_price'] ?? null,
                'currency' => strtoupper($validated['currency']),
                'lead_time' => $validated['lead_time'] ?? null,
                'note' => $validated['note'] ?? null,
                'responded_at' => now(),
            ]
        );

        ActivityLogger::log('quote.item.responded', $item, [
            'quote_no' => $quote->quote_no,
            'product_name' => $item->product_name,
        ], $request->user()?->id, $request, 'quote');

        $quote->load('items.responseItem');

        if ($quote->fresh(['items.responseItem'])->is_fully_responded && $quote->status !== 'responded') {
            $this->transitionStatus($quote, 'responded', $request->user()?->id, 'Tüm satırlar yanıtlandığı için durum otomatik güncellendi.');
        }

        return back()->with('status', 'Teklif satırı güncellendi.');
    }

    public function updateStatus(Request $request, QuoteRequest $quote): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,in_review,responded,closed'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validated['status'] === 'responded' && ! $quote->fresh(['items.responseItem'])->is_fully_responded) {
            return back()->withErrors([
                'status' => 'Tüm teklif satırları yanıtlanmadan durum cevaplandı olarak güncellenemez.',
            ]);
        }

        $this->transitionStatus($quote, $validated['status'], $request->user()?->id, $validated['note'] ?? null);

        ActivityLogger::log('quote.status.updated', $quote, [
            'status' => $validated['status'],
        ], $request->user()?->id, $request, 'quote');

        if ($validated['status'] === 'responded') {
            Mail::to($quote->requester_email)->queue(new QuoteRespondedMail($quote->fresh('items.responseItem')));
        }

        return back()->with('status', 'Teklif durumu güncellendi.');
    }

    private function transitionStatus(QuoteRequest $quote, string $toStatus, ?int $userId, ?string $note = null): void
    {
        DB::transaction(function () use ($quote, $toStatus, $userId, $note) {
            $fromStatus = $quote->status;
            $quote->update(['status' => $toStatus]);

            QuoteStatusHistory::create([
                'quote_request_id' => $quote->id,
                'user_id' => $userId,
                'from_status' => $fromStatus,
                'to_status' => $toStatus,
                'note' => $note,
            ]);
        });
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
