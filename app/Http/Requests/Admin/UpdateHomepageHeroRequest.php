<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateHomepageHeroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hero_mode' => ['required', 'in:static,slider'],
            'static' => ['nullable', 'array'],
            'static.eyebrow' => ['required', 'string', 'max:255'],
            'static.title' => ['required', 'string', 'max:255'],
            'static.description' => ['required', 'string', 'max:1000'],
            'static.primary_cta_label' => ['required', 'string', 'max:100'],
            'static.primary_cta_url' => ['required', 'string', 'max:255'],
            'static.secondary_cta_label' => ['nullable', 'string', 'max:100'],
            'static.secondary_cta_url' => ['nullable', 'string', 'max:255'],
            'static.support_items' => ['nullable', 'array', 'max:3'],
            'static.support_items.*' => ['nullable', 'string', 'max:255'],
            'slides' => ['nullable', 'array', 'max:5'],
            'slides.*.type' => ['nullable', 'in:product,category'],
            'slides.*.product_id' => ['nullable', 'integer'],
            'slides.*.category_id' => ['nullable', 'integer'],
            'slides.*.eyebrow' => ['nullable', 'string', 'max:255'],
            'slides.*.title_override' => ['nullable', 'string', 'max:255'],
            'slides.*.description_override' => ['nullable', 'string', 'max:1000'],
            'slides.*.primary_cta_label' => ['nullable', 'string', 'max:100'],
            'slides.*.primary_cta_url' => ['nullable', 'string', 'max:255'],
            'slides.*.secondary_cta_label' => ['nullable', 'string', 'max:100'],
            'slides.*.secondary_cta_url' => ['nullable', 'string', 'max:255'],
            'slides.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'slides.*.is_active' => ['nullable', 'boolean'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $slides = collect($this->input('slides', []))
                ->filter(fn (array $slide) => filled($slide['type'] ?? null));

            if ($slides->where('is_active', true)->count() > 5) {
                $validator->errors()->add('slides', 'En fazla 5 aktif hero slide tanımlanabilir.');
            }

            foreach ($slides as $index => $slide) {
                if (($slide['type'] ?? null) === 'product') {
                    $productId = $slide['product_id'] ?? null;

                    if (! $productId || ! Product::query()->whereKey($productId)->exists()) {
                        $validator->errors()->add("slides.$index.product_id", 'Geçerli bir ürün seçilmelidir.');
                    }
                }

                if (($slide['type'] ?? null) === 'category') {
                    $categoryId = $slide['category_id'] ?? null;

                    if (! $categoryId || ! Category::query()->whereKey($categoryId)->exists()) {
                        $validator->errors()->add("slides.$index.category_id", 'Geçerli bir kategori seçilmelidir.');
                    }
                }
            }
        });
    }
}
