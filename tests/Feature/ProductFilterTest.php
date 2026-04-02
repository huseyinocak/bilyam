<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSpecificationValue;
use App\Models\SpecificationField;
use App\Models\SpecificationTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_filtered_by_specification_value(): void
    {
        $category = Category::create([
            'name' => 'Filtre Kategori',
            'slug' => 'filtre-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $template = SpecificationTemplate::create([
            'category_id' => $category->id,
            'name' => 'Filtre Sablon',
            'slug' => 'filtre-sablon',
            'is_active' => true,
        ]);

        $field = SpecificationField::create([
            'specification_template_id' => $template->id,
            'name' => 'Cap',
            'key' => 'cap',
            'field_type' => 'text',
            'is_filterable' => true,
            'sort_order' => 1,
        ]);

        $first = Product::create([
            'category_id' => $category->id,
            'name' => 'Urun A',
            'slug' => 'urun-a',
            'code' => 'BLY-A',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 10,
            'is_active' => true,
        ]);

        $second = Product::create([
            'category_id' => $category->id,
            'name' => 'Urun B',
            'slug' => 'urun-b',
            'code' => 'BLY-B',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 20,
            'is_active' => true,
        ]);

        ProductSpecificationValue::create([
            'product_id' => $first->id,
            'specification_field_id' => $field->id,
            'value' => '120 mm',
        ]);

        ProductSpecificationValue::create([
            'product_id' => $second->id,
            'specification_field_id' => $field->id,
            'value' => '80 mm',
        ]);

        $response = $this->get(route('products.index', [
            'category' => $category->slug,
            'spec' => [$field->id => '120 mm'],
        ]));

        $response->assertOk();
        $response->assertSee('Urun A');
        $response->assertDontSee('Urun B');
    }
}
