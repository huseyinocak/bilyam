<?php

namespace Tests\Feature;

use App\Mail\AdminNewQuoteNotificationMail;
use App\Mail\QuoteRequestReceivedMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RolesAndAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OperationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_submission_creates_activity_log_and_queues_mails(): void
    {
        Mail::fake();

        $category = Category::create([
            'name' => 'Test Kategori',
            'slug' => 'test-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Urun',
            'slug' => 'test-urun',
            'code' => 'BLY-9001',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 150,
            'is_active' => true,
        ]);

        $response = $this
            ->withSession([
                'quote_list' => [
                    $product->id => ['product_id' => $product->id, 'quantity' => 2],
                ],
            ])
            ->post(route('quote-list.submit'), [
                'name' => 'Test Musteri',
                'email' => 'musteri@example.com',
            ]);

        $response->assertRedirect(route('quote-list.index'));
        $this->assertDatabaseHas('activity_logs', ['event' => 'quote.request.created']);
        Mail::assertQueued(QuoteRequestReceivedMail::class);
        Mail::assertQueued(AdminNewQuoteNotificationMail::class);
    }

    public function test_admin_can_create_category_and_activity_log_is_written(): void
    {
        $this->seed(RolesAndAdminSeeder::class);

        $admin = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'admin']);
        Role::findOrCreate('admin', 'web');
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Yeni Kategori',
            'slug' => 'yeni-kategori',
            'is_active' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['slug' => 'yeni-kategori']);
        $this->assertDatabaseHas('activity_logs', ['event' => 'catalog.category.created']);
    }
}
