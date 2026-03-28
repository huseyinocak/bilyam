<?php

namespace App\Http\Controllers\Public;

use App\Events\QuoteReceived;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuoteController extends Controller
{
    public function list(Request $request)
    {
        $items = collect($request->session()->get('quote_items', []));
        $products = Product::query()->whereIn('id', $items->keys()->all())->get()->keyBy('id');

        $lineItems = $items->map(function ($qty, $productId) use ($products) {
            $product = $products->get((int) $productId);

            return $product ? ['product' => $product, 'quantity' => max(1, (int) $qty)] : null;
        })->filter()->values();

        return view('quote.list', [
            'lineItems' => $lineItems,
        ]);
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->quote_enabled && $product->is_active, 404);

        $quantity = max(1, (int) $request->integer('quantity', 1));
        $items = $request->session()->get('quote_items', []);
        $items[$product->id] = ($items[$product->id] ?? 0) + $quantity;
        $request->session()->put('quote_items', $items);

        return back()->with('status', __('catalog.quote_item_added'));
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $items = Arr::except($request->session()->get('quote_items', []), [(string) $product->id]);
        $request->session()->put('quote_items', $items);

        return back()->with('status', __('catalog.quote_item_removed'));
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:32'],
            'email' => ['required', 'email', 'max:255'],
            'city' => ['nullable', 'string', 'max:120'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        $items = collect($request->session()->get('quote_items', []));
        abort_if($items->isEmpty(), 422, __('catalog.quote_requires_item'));

        $products = Product::query()->whereIn('id', $items->keys()->all())->get()->keyBy('id');

        $quote = QuoteRequest::query()->create([
            ...$validated,
            'customer_user_id' => auth()->id(),
            'status' => 'received',
        ]);

        foreach ($items as $productId => $qty) {
            $product = $products->get((int) $productId);
            if (! $product) {
                continue;
            }

            $quote->items()->create([
                'product_id' => $product->id,
                'quantity' => max(1, (int) $qty),
            ]);
        }

        QuoteReceived::dispatch($quote->load('items.product'));

        $request->session()->forget('quote_items');

        return redirect()->route('quote.list')->with('status', __('catalog.quote_submitted'));
    }
}
