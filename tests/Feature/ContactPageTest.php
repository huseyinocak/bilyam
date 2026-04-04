<?php

namespace Tests\Feature;

use App\Mail\AdminNewQuoteNotificationMail;
use App\Mail\ContactFormSubmittedMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\RolesAndAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_can_be_rendered_with_default_content(): void
    {
        $response = $this->get(route('contact.index'));

        $response->assertOk();
        $response->assertSee('İletişim');
    }

    public function test_contact_form_is_sent_to_contact_notification_email(): void
    {
        Mail::fake();

        Setting::putValue('contact.notification.email', 'string', 'contact-recipient@example.com', 'contact');

        $response = $this->post(route('contact.submit'), [
            'name' => 'İletişim Kullanıcısı',
            'email' => 'user@example.com',
            'phone' => '05550000000',
            'subject' => 'Genel Bilgi',
            'message' => 'Merhaba, bilgi almak istiyorum.',
        ]);

        $response->assertRedirect();
        Mail::assertQueued(ContactFormSubmittedMail::class, function ($mail) {
            return $mail->hasTo('contact-recipient@example.com');
        });
    }

    public function test_quote_form_uses_quote_notification_email_not_contact_email(): void
    {
        Mail::fake();

        Setting::putValue('contact.notification.email', 'string', 'contact-recipient@example.com', 'contact');
        Setting::putValue('quote.notification.email', 'string', 'quote-recipient@example.com', 'contact');

        $category = Category::create([
            'name' => 'Test Kategori',
            'slug' => 'test-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Ürün',
            'slug' => 'test-urun',
            'code' => 'BLY-CNT1',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 100,
            'is_active' => true,
        ]);

        $response = $this
            ->withSession([
                'quote_list' => [
                    $product->id => ['product_id' => $product->id, 'quantity' => 1],
                ],
            ])
            ->post(route('quote-list.submit'), [
                'name' => 'Teklif Kullanıcısı',
                'email' => 'quote-user@example.com',
            ]);

        $response->assertRedirect();
        Mail::assertQueued(AdminNewQuoteNotificationMail::class, function ($mail) {
            return $mail->hasTo('quote-recipient@example.com') && ! $mail->hasTo('contact-recipient@example.com');
        });
    }

    public function test_admin_can_update_contact_settings(): void
    {
        $this->seed(RolesAndAdminSeeder::class);

        $admin = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'admin']);
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->patch(route('admin.settings.contact.update'), [
            'content' => [
                'title' => 'Bize Ulaşın',
                'description' => 'Açıklama',
                'phone' => '+90 555 111 11 11',
                'email' => 'info@example.com',
                'address' => 'Adres',
                'working_hours' => '09:00 - 18:00',
                'map_embed_url' => 'https://www.google.com/maps?q=Istanbul&output=embed',
                'map_link' => 'https://maps.google.com/?q=Istanbul',
                'form_title' => 'Form Başlığı',
                'form_description' => 'Form açıklaması',
            ],
            'contact_notification_email' => 'contact@example.com',
            'quote_notification_email' => 'quote@example.com',
        ]);

        $response->assertRedirect();
        $this->assertSame('Bize Ulaşın', Setting::getValue('contact.page.content')['title']);
        $this->assertSame('contact@example.com', Setting::getValue('contact.notification.email'));
        $this->assertSame('quote@example.com', Setting::getValue('quote.notification.email'));
    }
}
