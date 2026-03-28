<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Contracts\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $offers = QuoteRequest::query()
            ->where('customer_user_id', auth()->id())
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view('customer.offers.index', compact('offers'));
    }

    public function show(QuoteRequest $quoteRequest): View
    {
        abort_unless((int) $quoteRequest->customer_user_id === (int) auth()->id(), 403);

        $quoteRequest->load('items.product');

        return view('customer.offers.show', ['offer' => $quoteRequest]);
    }
}
