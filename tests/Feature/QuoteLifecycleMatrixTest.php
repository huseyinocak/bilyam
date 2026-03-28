<?php

namespace Tests\Feature;

use App\Events\QuoteReceived;
use App\Models\Category;
use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\TestCase;

class QuoteLifecycleMatrixTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_submit_quote_and_event_is_dispatched(): void
    {
        Event::fake();

        $product = $this->createProduct();

        $this->post(route('quote.add', $product), ['quantity' => 2])->assertRedirect();

        $this->post(route('quote.submit'), [
            'full_name' => 'Misafir Kullanıcı',
            'company_name' => 'Demo Ltd',
            'phone' => '5551234567',
            'email' => 'guest@example.com',
        ])->assertRedirect(route('quote.list'));

        $this->assertDatabaseHas('quote_requests', [
            'email' => 'guest@example.com',
            'customer_user_id' => null,
        ]);

        Event::assertDispatched(QuoteReceived::class);
    }

    public function test_customer_offer_routes_require_authentication(): void
    {
        $this->get(route('customer.offers.index'))->assertRedirectContains('/login');
    }

    public function test_customer_can_view_only_own_offer(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();

        $quote = QuoteRequest::query()->create([
            'customer_user_id' => $owner->id,
            'full_name' => 'Owner User',
            'company_name' => 'Owner Co',
            'phone' => '5551112233',
            'email' => 'owner@example.com',
            'status' => 'received',
        ]);

        $this->actingAs($other)
            ->get(route('customer.offers.show', $quote))
            ->assertForbidden();
    }

    public function test_admin_routes_require_authentication(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirectContains('/login');
    }

    private function createProduct(): Product
    {
        $category = Category::query()->create(['name' => 'Kategori', 'slug' => 'kategori']);

        return Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Matrix Ürün',
            'slug' => Str::slug('Matrix Ürün'),
            'quote_enabled' => true,
            'is_active' => true,
        ]);
    }
}
