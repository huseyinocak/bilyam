<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CatalogFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_page_is_accessible(): void
    {
        $category = Category::query()->create(['name' => 'Test Kategori', 'slug' => 'test-kategori']);
        Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Test Ürün',
            'slug' => Str::slug('Test Ürün'),
            'quote_enabled' => true,
        ]);

        $this->get(route('catalog.index'))
            ->assertOk()
            ->assertSee('Test Ürün');
    }

    public function test_quote_submit_requires_minimum_fields(): void
    {
        $response = $this->post(route('quote.submit'), []);

        $response->assertSessionHasErrors([
            'full_name',
            'company_name',
            'phone',
            'email',
        ]);
    }
}
