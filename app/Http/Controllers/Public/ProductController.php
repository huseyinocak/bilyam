<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSpecificationValue;
use App\Models\SpecificationTemplate;
use App\Models\UseCase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));
        $category = $request->string('category')->toString();
        $brand = $request->string('brand')->toString();
        $useCase = $request->string('use_case')->toString();
        $specificationFilters = collect((array) $request->input('spec', []))
            ->map(fn ($value) => trim((string) $value))
            ->filter();

        $query = Product::query()
            ->with(['category', 'brand', 'useCases', 'images', 'primaryImage', 'specificationValues.field'])
            ->where('is_active', true)
            ->where('visibility_mode', 'public');

        if ($search !== '') {
            $query->where(function (Builder $builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhereHas('category', fn (Builder $q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('useCases', fn (Builder $q) => $q->where('name', 'like', "%{$search}%"));
            });
        }

        if ($category !== '') {
            $query->whereHas('category', fn (Builder $q) => $q->where('slug', $category));
        }

        if ($brand !== '') {
            $query->whereHas('brand', fn (Builder $q) => $q->where('slug', $brand));
        }

        if ($useCase !== '') {
            $query->whereHas('useCases', fn (Builder $q) => $q->where('slug', $useCase));
        }

        foreach ($specificationFilters as $fieldId => $value) {
            $query->whereHas('specificationValues', function (Builder $builder) use ($fieldId, $value) {
                $builder->where('specification_field_id', $fieldId)->where('value', $value);
            });
        }

        $selectedCategoryModel = $category !== '' ? Category::query()->where('slug', $category)->first() : null;
        $filterTemplate = $selectedCategoryModel
            ? SpecificationTemplate::query()->with(['fields' => fn ($query) => $query->where('is_filterable', true)->orderBy('sort_order')])->where('category_id', $selectedCategoryModel->id)->first()
            : null;

        $filterFields = collect($filterTemplate?->fields ?? [])->map(function ($field) use ($selectedCategoryModel) {
            $values = ProductSpecificationValue::query()
                ->select('value')
                ->where('specification_field_id', $field->id)
                ->whereHas('product', fn (Builder $query) => $query->where('category_id', $selectedCategoryModel?->id)->where('is_active', true)->where('visibility_mode', 'public'))
                ->distinct()
                ->orderBy('value')
                ->pluck('value');

            return [
                'field' => $field,
                'values' => $values,
            ];
        })->filter(fn ($item) => $item['values']->isNotEmpty())->values();

        $products = $query->latest('id')->paginate((int) $request->integer('per_page', 10))->withQueryString();

        return view('public.products.index', [
            'products' => $products,
            'categories' => Category::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'brands' => Brand::query()->where('is_active', true)->orderBy('name')->get(),
            'useCases' => UseCase::query()->where('is_active', true)->orderBy('name')->get(),
            'selectedCategory' => $category,
            'selectedBrand' => $brand,
            'selectedUseCase' => $useCase,
            'search' => $search,
            'filterFields' => $filterFields,
            'specificationFilters' => $specificationFilters,
        ]);
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active && $product->visibility_mode === 'public', 404);

        $product->load([
            'category',
            'brand',
            'useCases',
            'images',
            'specificationValues.field',
        ]);

        $relatedProducts = Product::query()
            ->with(['category', 'brand', 'images'])
            ->where('is_active', true)
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->take(4)
            ->get();

        return view('public.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
