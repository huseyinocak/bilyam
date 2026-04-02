<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private array $protectedRoles = ['super_admin', 'admin', 'operation', 'content_manager', 'customer'];

    public function index(): View
    {
        return view('admin.roles.index', [
            'roles' => Role::query()->with(['permissions'])->withCount('users')->orderBy('name')->get(),
            'permissions' => Permission::query()->orderBy('name')->get(),
            'protectedRoles' => $this->protectedRoles,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);

        ActivityLogger::log('auth.role.created', $role, ['name' => $role->name], $request->user()?->id, $request, 'auth');

        return back()->with('status', 'Rol olusturuldu.');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'permission_names' => ['nullable', 'array'],
            'permission_names.*' => ['exists:permissions,name'],
        ]);

        $role->syncPermissions($validated['permission_names'] ?? []);

        ActivityLogger::log('auth.role.updated', $role, ['name' => $role->name], $request->user()?->id, $request, 'auth');

        return back()->with('status', 'Rol izinleri guncellendi.');
    }

    public function destroy(Request $request, Role $role): RedirectResponse
    {
        if (in_array($role->name, $this->protectedRoles, true)) {
            return back()->withErrors(['role' => 'Bu rol sistem tarafindan korunuyor.']);
        }

        if ($role->users()->exists()) {
            return back()->withErrors(['role' => 'Kullanici atamasi olan rol silinemez.']);
        }

        $name = $role->name;
        $role->delete();

        ActivityLogger::log('auth.role.deleted', null, ['name' => $name], $request->user()?->id, $request, 'auth');

        return back()->with('status', 'Rol silindi.');
    }
}
