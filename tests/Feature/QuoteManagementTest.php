<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\QuoteItem;
use App\Models\QuoteRequest;
use App\Models\User;
use Database\Seeders\RolesAndAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class QuoteManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_their_quote_list_and_detail(): void
    {
        $customer = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'customer']);
        Role::findOrCreate('customer', 'web');
        $customer->assignRole('customer');

        $quote = QuoteRequest::create([
            'quote_no' => 'TKT-20260401-AAA11',
            'customer_user_id' => $customer->id,
            'status' => 'new',
            'requester_name' => $customer->name,
            'requester_email' => $customer->email,
            'submitted_at' => now(),
        ]);

        QuoteItem::create([
            'quote_request_id' => $quote->id,
            'product_name' => 'Test Urun',
            'product_code' => 'BLY-0101',
            'quantity' => 2,
        ]);

        $this->actingAs($customer)
            ->get(route('account.quotes.index'))
            ->assertOk()
            ->assertSee($quote->quote_no);

        $this->actingAs($customer)
            ->get(route('account.quotes.show', $quote))
            ->assertOk()
            ->assertSee('Test Urun');
    }

    public function test_customer_can_reorder_previous_quote_items(): void
    {
        $customer = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'customer']);
        Role::findOrCreate('customer', 'web');
        $customer->assignRole('customer');

        $category = Category::create([
            'name' => 'Test Kategori',
            'slug' => 'test-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Tekrar Talep Urunu',
            'slug' => 'tekrar-talep-urunu',
            'code' => 'BLY-0202',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 100,
            'is_active' => true,
        ]);

        $quote = QuoteRequest::create([
            'quote_no' => 'TKT-20260401-BBB22',
            'customer_user_id' => $customer->id,
            'status' => 'responded',
            'requester_name' => $customer->name,
            'requester_email' => $customer->email,
            'submitted_at' => now(),
        ]);

        QuoteItem::create([
            'quote_request_id' => $quote->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_code' => $product->code,
            'quantity' => 4,
        ]);

        $response = $this->actingAs($customer)->post(route('account.quotes.reorder', $quote));

        $response->assertRedirect(route('quote-list.index'));
        $response->assertSessionHas('quote_list');
    }

    public function test_admin_can_update_quote_item_and_status(): void
    {
        $this->seed(RolesAndAdminSeeder::class);

        $admin = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'admin']);
        Role::findOrCreate('admin', 'web');
        $admin->assignRole('admin');

        $quote = QuoteRequest::create([
            'quote_no' => 'TKT-20260401-CCC33',
            'status' => 'new',
            'requester_name' => 'Firma Yetkilisi',
            'requester_email' => 'firma@example.com',
            'submitted_at' => now(),
        ]);

        $item = QuoteItem::create([
            'quote_request_id' => $quote->id,
            'product_name' => 'Operasyon Urunu',
            'product_code' => 'BLY-0303',
            'quantity' => 5,
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.quotes.items.update', [$quote, $item]), [
                'unit_price' => 250,
                'currency' => 'TRY',
                'lead_time' => '3 is gunu',
                'note' => 'Hazir stoktan sevk edilebilir.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('quote_response_items', [
            'quote_item_id' => $item->id,
            'currency' => 'TRY',
            'lead_time' => '3 is gunu',
        ]);

        $this->actingAs($admin)
            ->patch(route('admin.quotes.status.update', $quote), [
                'status' => 'responded',
                'note' => 'Tum kalemler cevaplandi.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('quote_requests', [
            'id' => $quote->id,
            'status' => 'responded',
        ]);
    }
}
