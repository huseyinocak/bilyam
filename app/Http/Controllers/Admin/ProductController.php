<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecificationValue;
use App\Models\SpecificationTemplate;
use App\Models\UseCase;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));

        return view('admin.catalog.products.index', [
            'products' => Product::query()
                ->with(['category', 'brand', 'useCases', 'primaryImage', 'images', 'specificationValues.field'])
                ->when($search, fn ($query) => $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('code', 'like', "%{$search}%")))
                ->latest('id')
                ->paginate(12)
                ->withQueryString(),
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
            'brands' => Brand::query()->where('is_active', true)->orderBy('name')->get(),
            'useCases' => UseCase::query()->where('is_active', true)->orderBy('name')->get(),
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('admin.catalog.products.create', $this->formData(new Product));
    }

    public function edit(Product $product): View
    {
        $product->load(['category', 'brand', 'useCases', 'images', 'primaryImage', 'specificationValues.field']);

        return view('admin.catalog.products.edit', $this->formData($product));
    }

    public function store(Request $request): RedirectResponse
    {
        $product = Product::create($this->validatedData($request));
        $product->useCases()->sync($request->input('use_case_ids', []));
        $this->syncPrimaryImage($request, $product);
        $this->syncGalleryImages($request, $product);
        $this->syncSpecificationValues($request, $product);

        ActivityLogger::log('catalog.product.created', $product, ['name' => $product->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Urun olusturuldu.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->validatedData($request, $product));
        $product->useCases()->sync($request->input('use_case_ids', []));
        $this->syncPrimaryImage($request, $product);
        $this->syncGalleryImages($request, $product);
        $this->syncSpecificationValues($request, $product);

        ActivityLogger::log('catalog.product.updated', $product, ['name' => $product->name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Urun guncellendi.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        ActivityLogger::log('catalog.product.deleted', null, ['name' => $name], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Urun silindi.');
    }

    public function destroyImage(Request $request, Product $product, ProductImage $image): RedirectResponse
    {
        abort_unless($image->product_id === $product->id, 404);

        if ($image->path && str_starts_with($image->path, 'products/')) {
            Storage::disk('public')->delete($image->path);
        }

        $wasPrimary = $image->is_primary;
        $image->delete();

        if ($wasPrimary) {
            $fallback = $product->images()->orderBy('sort_order')->first();

            if ($fallback) {
                $fallback->update(['is_primary' => true]);
            }
        }

        ActivityLogger::log('catalog.product.image.deleted', $product, ['image_id' => $image->id], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Urun gorseli silindi.');
    }

    public function makePrimaryImage(Request $request, Product $product, ProductImage $image): RedirectResponse
    {
        abort_unless($image->product_id === $product->id, 404);

        $product->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        ActivityLogger::log('catalog.product.image.primary', $product, ['image_id' => $image->id], $request->user()?->id, $request, 'catalog');

        return back()->with('status', 'Birincil gorsel guncellendi.');
    }

    private function validatedData(Request $request, ?Product $product = null): array
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.($product?->id ?? 'NULL').',id'],
            'code' => ['required', 'string', 'max:255', 'unique:products,code,'.($product?->id ?? 'NULL').',id'],
            'technical_summary' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'stock_status' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'show_price' => ['nullable', 'boolean'],
            'show_stock' => ['nullable', 'boolean'],
            'use_case_ids' => ['nullable', 'array'],
            'use_case_ids.*' => ['exists:use_cases,id'],
            'specification_values' => ['nullable', 'array'],
            'specification_values.*' => ['nullable', 'string', 'max:255'],
        ]);

        return [
            'category_id' => $validated['category_id'] ?? null,
            'brand_id' => $validated['brand_id'] ?? null,
            'name' => $validated['name'],
            'slug' => ($validated['slug'] ?? null) ?: Str::slug($validated['name']),
            'code' => strtoupper($validated['code']),
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'stock_status' => $validated['stock_status'] ?? null,
            'price_currency' => 'TRY',
            'price' => $validated['price'] ?? null,
            'technical_summary' => $validated['technical_summary'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'show_price' => (bool) ($validated['show_price'] ?? false),
            'show_stock' => (bool) ($validated['show_stock'] ?? false),
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ];
    }

    private function syncPrimaryImage(Request $request, Product $product): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        $request->validate([
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $existing = $product->primaryImage;

        if ($existing && $existing->path) {
            Storage::disk('public')->delete($existing->path);
        }

        $path = $request->file('image')->store('products', 'public');

        ProductImage::updateOrCreate(
            ['product_id' => $product->id, 'is_primary' => true],
            ['path' => $path, 'alt_text' => $product->name, 'sort_order' => 0]
        );
    }

    private function syncGalleryImages(Request $request, Product $product): void
    {
        if (! $request->hasFile('gallery_images')) {
            return;
        }

        $request->validate([
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'max:4096'],
        ]);

        $nextSort = ((int) $product->images()->max('sort_order')) + 1;

        foreach ((array) $request->file('gallery_images') as $file) {
            if (! $file) {
                continue;
            }

            $path = $file->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
                'alt_text' => $product->name,
                'is_primary' => false,
                'sort_order' => $nextSort++,
            ]);
        }
    }

    private function syncSpecificationValues(Request $request, Product $product): void
    {
        foreach ((array) $request->input('specification_values', []) as $fieldId => $value) {
            $cleanValue = trim((string) $value);

            if ($cleanValue === '') {
                ProductSpecificationValue::query()
                    ->where('product_id', $product->id)
                    ->where('specification_field_id', $fieldId)
                    ->delete();

                continue;
            }

            ProductSpecificationValue::updateOrCreate(
                ['product_id' => $product->id, 'specification_field_id' => $fieldId],
                ['value' => $cleanValue]
            );
        }
    }

    private function formData(Product $product): array
    {
        return [
            'product' => $product,
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
            'brands' => Brand::query()->where('is_active', true)->orderBy('name')->get(),
            'useCases' => UseCase::query()->where('is_active', true)->orderBy('name')->get(),
            'templates' => SpecificationTemplate::query()->with('fields')->where('is_active', true)->get()->keyBy('category_id'),
        ];
    }
}
