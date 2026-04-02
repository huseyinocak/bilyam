<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_robots_txt_is_served(): void
    {
        $response = $this->get(route('robots'));

        $response->assertOk();
        $response->assertSee('Disallow: /admin', false);
        $response->assertSee('Sitemap:', false);
    }

    public function test_sitemap_contains_public_urls(): void
    {
        $category = Category::create([
            'name' => 'Seo Kategori',
            'slug' => 'seo-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Seo Urunu',
            'slug' => 'seo-urunu',
            'code' => 'BLY-SEO1',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 50,
            'is_active' => true,
        ]);

        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertSee(route('products.show', $product, absolute: true), false);
        $response->assertSee(route('categories.show', $category, absolute: true), false);
    }

    public function test_public_product_page_has_canonical_and_description_meta(): void
    {
        $category = Category::create([
            'name' => 'Meta Kategori',
            'slug' => 'meta-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Meta Urunu',
            'slug' => 'meta-urunu',
            'code' => 'BLY-META',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 100,
            'technical_summary' => '60x120x23 mm | Precision Ball',
            'is_active' => true,
        ]);

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertSee('rel="canonical"', false);
        $response->assertSee('60x120x23 mm | Precision Ball', false);
    }

    public function test_customer_panel_pages_are_noindex(): void
    {
        $user = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'customer']);
        Role::findOrCreate('customer', 'web');
        $user->assignRole('customer');

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('noindex,nofollow', false);
    }
}
