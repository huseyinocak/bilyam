<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SpecificationField;
use App\Models\SpecificationTemplate;
use App\Models\User;
use Database\Seeders\RolesAndAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $this->seed(RolesAndAdminSeeder::class);

        $admin = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'admin']);
        Role::findOrCreate('admin', 'web');
        $admin->assignRole('admin');

        return $admin;
    }

    public function test_admin_can_create_user_and_role(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->post(route('admin.roles.store'), [
            'name' => 'sales_manager',
        ])->assertRedirect();

        $this->assertDatabaseHas('roles', ['name' => 'sales_manager']);

        $this->actingAs($admin)->post(route('admin.users.store'), [
            'name' => 'Yeni Kullanici',
            'email' => 'yeni@example.com',
            'phone' => '05551234567',
            'user_type' => 'admin',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role_names' => ['sales_manager'],
        ])->assertRedirect();

        $this->assertDatabaseHas('users', ['email' => 'yeni@example.com']);
    }

    public function test_admin_can_create_specification_template_and_field(): void
    {
        $admin = $this->admin();
        $category = Category::create([
            'name' => 'Test Kategori',
            'slug' => 'test-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->actingAs($admin)->post(route('admin.specification-templates.store'), [
            'category_id' => $category->id,
            'name' => 'Motor Teknik Ozellikleri',
            'slug' => 'motor-teknik-ozellikleri',
            'is_active' => 1,
        ])->assertRedirect();

        $template = SpecificationTemplate::firstOrFail();

        $this->actingAs($admin)->post(route('admin.specification-templates.fields.store', $template), [
            'name' => 'Cap',
            'key' => 'cap',
            'field_type' => 'text',
            'is_filterable' => 1,
        ])->assertRedirect();

        $this->assertDatabaseHas('specification_fields', ['key' => 'cap']);
    }

    public function test_admin_can_update_role_permissions(): void
    {
        $admin = $this->admin();
        $role = Role::findByName('admin', 'web');

        $this->actingAs($admin)->patch(route('admin.roles.update', $role), [
            'permission_names' => ['dashboard.view', 'quotes.manage'],
        ])->assertRedirect();

        $this->assertTrue($role->fresh()->hasPermissionTo('dashboard.view'));
        $this->assertTrue($role->fresh()->hasPermissionTo('quotes.manage'));
    }

    public function test_admin_can_upload_product_image(): void
    {
        Storage::fake('public');

        $admin = $this->admin();
        $category = Category::create([
            'name' => 'Test Kategori',
            'slug' => 'test-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $brand = Brand::create([
            'name' => 'Test Marka',
            'slug' => 'test-marka',
            'is_active' => true,
        ]);

        $this->actingAs($admin)->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name' => 'Gorselli Urun',
            'code' => 'BLY-IMG1',
            'price' => 100,
            'is_active' => 1,
            'image' => UploadedFile::fake()->create('urun.jpg', 150, 'image/jpeg'),
        ])->assertRedirect();

        $product = Product::where('code', 'BLY-IMG1')->firstOrFail();
        $this->assertDatabaseHas('product_images', ['product_id' => $product->id, 'is_primary' => 1]);
        $this->assertTrue(Storage::disk('public')->exists($product->primaryImage->path));
    }

    public function test_admin_can_upload_gallery_images_and_specification_values(): void
    {
        Storage::fake('public');

        $admin = $this->admin();
        $category = Category::create([
            'name' => 'Test Kategori',
            'slug' => 'test-kategori',
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $brand = Brand::create([
            'name' => 'Test Marka',
            'slug' => 'test-marka',
            'is_active' => true,
        ]);
        $template = SpecificationTemplate::create([
            'category_id' => $category->id,
            'name' => 'Test Sablon',
            'slug' => 'test-sablon',
            'is_active' => true,
        ]);
        $field = SpecificationField::create([
            'specification_template_id' => $template->id,
            'name' => 'Cap',
            'key' => 'cap',
            'field_type' => 'text',
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name' => 'Galeri Urunu',
            'slug' => 'galeri-urunu',
            'code' => 'BLY-GAL1',
            'sales_mode' => 'quote',
            'visibility_mode' => 'public',
            'price_currency' => 'TRY',
            'price' => 100,
            'is_active' => true,
        ]);

        $this->actingAs($admin)->patch(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'code' => $product->code,
            'price' => 100,
            'is_active' => 1,
            'gallery_images' => [
                UploadedFile::fake()->create('galeri-1.jpg', 100, 'image/jpeg'),
                UploadedFile::fake()->create('galeri-2.jpg', 100, 'image/jpeg'),
            ],
            'specification_values' => [
                $field->id => '120 mm',
            ],
        ])->assertRedirect();

        $this->assertGreaterThanOrEqual(2, ProductImage::where('product_id', $product->id)->count());
        $this->assertDatabaseHas('product_specification_values', [
            'product_id' => $product->id,
            'specification_field_id' => $field->id,
            'value' => '120 mm',
        ]);
    }
}
