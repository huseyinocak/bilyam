<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\RolesAndAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomepageHeroSettingsTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $this->seed(RolesAndAdminSeeder::class);

        $admin = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'admin']);
        $admin->assignRole('admin');

        return $admin;
    }

    public function test_homepage_uses_static_hero_by_default(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Endüstriyel Teknik Ürün Tedariği');
    }

    public function test_admin_can_save_homepage_hero_settings(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->patch(route('admin.settings.homepage-hero.update'), [
            'hero_mode' => 'static',
            'static' => [
                'eyebrow' => 'Test Hero',
                'title' => 'Test Başlık',
                'description' => 'Test açıklama',
                'primary_cta_label' => 'İncele',
                'primary_cta_url' => '/products',
                'secondary_cta_label' => 'Teklif',
                'secondary_cta_url' => '/quote-list',
                'support_items' => ['Madde 1', 'Madde 2', 'Madde 3'],
            ],
            'slides' => [],
        ]);

        $response->assertRedirect();
        $this->assertSame('static', Setting::getValue('homepage.hero.mode'));
        $this->assertSame('Test Başlık', Setting::getValue('homepage.hero.static')['title']);
    }

    public function test_homepage_can_render_slider_hero(): void
    {
        $category = Category::create([
            'name' => 'Slider Kategori',
            'slug' => 'slider-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Slider Ürün',
            'slug' => 'slider-urun',
            'code' => 'BLY-SLIDE',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 100,
            'is_active' => true,
        ]);

        Setting::putValue('homepage.hero.mode', 'string', 'slider', 'homepage');
        Setting::putValue('homepage.hero.slides', 'json', [
            [
                'type' => 'product',
                'id' => $product->id,
                'eyebrow' => 'Öne Çıkan',
                'title_override' => 'Slider Başlık',
                'description_override' => 'Slider açıklama',
                'primary_cta_label' => 'Ürünü İncele',
                'primary_cta_url' => route('products.show', $product),
                'secondary_cta_label' => 'Teklif Oluştur',
                'secondary_cta_url' => route('quote-list.index'),
                'sort_order' => 1,
                'is_active' => true,
            ],
        ], 'homepage');

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Slider Başlık');
        $response->assertSee('Slider açıklama');
    }

    public function test_slider_validation_rejects_more_than_five_active_items(): void
    {
        $admin = $this->admin();

        $slides = [];

        for ($i = 0; $i < 6; $i++) {
            $category = Category::create([
                'name' => 'Kategori '.$i,
                'slug' => 'kategori-'.$i,
                'is_active' => true,
                'sort_order' => $i,
            ]);

            $slides[] = [
                'type' => 'category',
                'category_id' => $category->id,
                'eyebrow' => 'Kategori',
                'sort_order' => $i,
                'is_active' => 1,
            ];
        }

        $response = $this->actingAs($admin)->patch(route('admin.settings.homepage-hero.update'), [
            'hero_mode' => 'slider',
            'static' => [
                'eyebrow' => 'Hero',
                'title' => 'Başlık',
                'description' => 'Açıklama',
                'primary_cta_label' => 'İncele',
                'primary_cta_url' => '/products',
                'support_items' => ['A', 'B', 'C'],
            ],
            'slides' => $slides,
        ]);

        $response->assertSessionHasErrors('slides');
    }

    public function test_category_image_can_be_uploaded(): void
    {
        Storage::fake('public');

        $admin = $this->admin();

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'name' => 'Görselli Kategori',
            'slug' => 'gorselli-kategori',
            'is_active' => 1,
            'image_alt' => 'Kategori görseli',
            'image' => UploadedFile::fake()->create('kategori.jpg', 120, 'image/jpeg'),
        ]);

        $response->assertRedirect();

        $category = Category::where('slug', 'gorselli-kategori')->firstOrFail();

        $this->assertNotNull($category->image_path);
        $this->assertTrue(Storage::disk('public')->exists($category->image_path));
    }
}
