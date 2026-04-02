<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'quotes.view',
            'quotes.manage',
            'catalog.products.view',
            'catalog.products.manage',
            'catalog.categories.manage',
            'catalog.brands.manage',
            'catalog.use_cases.manage',
            'catalog.specifications.manage',
            'users.manage',
            'roles.manage',
            'activity_logs.view',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        foreach (['super_admin', 'admin', 'operation', 'content_manager', 'customer'] as $role) {
            Role::findOrCreate($role, 'web');
        }

        Role::findByName('super_admin', 'web')->syncPermissions($permissions);
        Role::findByName('admin', 'web')->syncPermissions($permissions);
        Role::findByName('operation', 'web')->syncPermissions([
            'dashboard.view',
            'quotes.view',
            'quotes.manage',
            'catalog.products.view',
            'activity_logs.view',
        ]);
        Role::findByName('content_manager', 'web')->syncPermissions([
            'dashboard.view',
            'catalog.products.view',
            'catalog.products.manage',
            'catalog.categories.manage',
            'catalog.brands.manage',
            'catalog.use_cases.manage',
            'catalog.specifications.manage',
        ]);
        Role::findByName('customer', 'web')->syncPermissions([]);

        $admin = User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@bilyam.test')],
            [
                'name' => env('ADMIN_NAME', 'Bilyam Admin'),
                'phone' => env('ADMIN_PHONE', '05550000000'),
                'user_type' => 'admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'email_verified_at' => now(),
            ]
        );

        $admin->syncRoles(['super_admin']);

        CustomerProfile::firstOrCreate(
            ['user_id' => $admin->id],
            ['contact_name' => $admin->name]
        );

        CompanyProfile::firstOrCreate([
            'user_id' => $admin->id,
        ]);
    }
}
