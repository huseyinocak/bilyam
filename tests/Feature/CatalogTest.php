<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\CatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_page_can_be_rendered(): void
    {
        $this->seed(CatalogSeeder::class);

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertSee('Teknik ürün kataloğu');
    }

    public function test_product_detail_page_can_be_rendered(): void
    {
        $this->seed(CatalogSeeder::class);
        $product = Product::firstOrFail();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee($product->code);
    }

    public function test_quote_request_can_be_submitted_from_quote_list(): void
    {
        $this->seed(CatalogSeeder::class);
        $product = Product::firstOrFail();

        $response = $this
            ->withSession([
                'quote_list' => [
                    $product->id => ['product_id' => $product->id, 'quantity' => 3],
                ],
            ])
            ->post(route('quote-list.submit'), [
                'name' => 'Test Kullanici',
                'email' => 'test@example.com',
                'phone' => '05550000000',
                'company_name' => 'Test Firma',
                'tax_number' => '1234567890',
                'note' => 'Toplu alim icin teklif bekleniyor.',
            ]);

        $response->assertRedirect(route('quote-list.index'));
        $this->assertDatabaseCount('quote_requests', 1);
        $this->assertDatabaseCount('quote_items', 1);
        $this->assertDatabaseHas('quote_items', [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);
    }
}
