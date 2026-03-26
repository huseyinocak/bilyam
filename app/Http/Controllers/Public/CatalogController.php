<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true);

        if ($request->filled('q')) {
            $search = trim((string) $request->string('q'));
            $query->where(function ($inner) use ($search) {
                $inner->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->string('category')));
        }

        $products = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('catalog.index', [
            'products' => $products,
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);
        $product->load(['category', 'brand']);

        return view('catalog.show', compact('product'));
    }
}
