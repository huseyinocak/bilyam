<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesAndAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PermissionEnforcementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_without_permission_cannot_access_activity_logs(): void
    {
        $this->seed(RolesAndAdminSeeder::class);

        $user = User::factory()->create(['email_verified_at' => now(), 'user_type' => 'admin']);
        Role::findOrCreate('admin', 'web')->syncPermissions([]);
        $user->assignRole('admin');
        $user->syncPermissions([]);

        $this->actingAs($user)
            ->get(route('admin.activity-logs.index'))
            ->assertForbidden();
    }
}
