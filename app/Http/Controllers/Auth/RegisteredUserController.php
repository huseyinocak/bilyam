<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\CustomerProfile;
use App\Models\User;
use App\Support\ActivityLogger;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => 'customer',
            'password' => Hash::make($request->password),
        ]);

        Role::findOrCreate('customer', 'web');
        $user->assignRole('customer');

        CustomerProfile::create([
            'user_id' => $user->id,
            'contact_name' => $user->name,
        ]);

        CompanyProfile::create([
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        ActivityLogger::log('auth.customer.registered', $user, ['email' => $user->email], $user->id, $request, 'auth');

        return redirect(route('dashboard', absolute: false));
    }
}
