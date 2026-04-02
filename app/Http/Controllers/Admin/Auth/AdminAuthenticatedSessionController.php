<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthenticatedSessionController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()?->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $key = Str::lower($request->string('email')).'|'.$request->ip().'|admin';

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'email' => "Cok fazla giris denemesi yapildi. {$seconds} saniye sonra tekrar deneyin.",
            ]);
        }

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            RateLimiter::hit($key);

            throw ValidationException::withMessages([
                'email' => 'Girilen bilgiler dogrulanamadi.',
            ]);
        }

        if (! $request->user()?->isAdmin()) {
            Auth::logout();
            RateLimiter::hit($key);

            throw ValidationException::withMessages([
                'email' => 'Bu kullanici icin yonetim paneli yetkisi tanimli degil.',
            ]);
        }

        RateLimiter::clear($key);
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
