<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\CustomerProfile;
use App\Models\User;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->with('roles')->latest()->paginate(15),
            'roles' => Role::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'user_type' => ['required', 'in:admin,customer'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_names' => ['nullable', 'array'],
            'role_names.*' => ['exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'user_type' => $validated['user_type'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->syncRoles($validated['role_names'] ?? []);

        CustomerProfile::firstOrCreate(['user_id' => $user->id], ['contact_name' => $user->name]);
        CompanyProfile::firstOrCreate(['user_id' => $user->id]);

        ActivityLogger::log('auth.user.created', $user, ['email' => $user->email], $request->user()?->id, $request, 'auth');

        return back()->with('status', 'Kullanici olusturuldu.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'user_type' => ['required', 'in:admin,customer'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role_names' => ['nullable', 'array'],
            'role_names.*' => ['exists:roles,name'],
        ]);

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'user_type' => $validated['user_type'],
        ];

        if (! empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);
        $user->syncRoles($validated['role_names'] ?? []);

        ActivityLogger::log('auth.user.updated', $user, ['email' => $user->email], $request->user()?->id, $request, 'auth');

        return back()->with('status', 'Kullanici guncellendi.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        abort_if($request->user()?->id === $user->id, 422, 'Aktif oturumu kullanan yoneticiyi silemezsiniz.');

        $email = $user->email;
        $user->delete();

        ActivityLogger::log('auth.user.deleted', null, ['email' => $email], $request->user()?->id, $request, 'auth');

        return back()->with('status', 'Kullanici silindi.');
    }
}
