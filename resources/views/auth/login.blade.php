<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 space-y-2">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Müşteri Girişi</p>
        <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Hesabiniza giris yapin</h1>
        <p class="text-sm text-slate-600 dark:text-slate-300">Tekliflerinizi takip etmek, profilinizi yonetmek ve tekrar talep olusturmak icin giris yapin.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="admin_intent" value="0">

        <div>
            <x-input-label for="email" :value="'E-posta'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Şifre'" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-bilya-blue shadow-sm focus:ring-bilya-blue" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-slate-300">Beni hatirla</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bilya-blue dark:text-slate-300 dark:hover:text-white" href="{{ route('password.request') }}">
                    Şifrenizi mi unuttunuz?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Giriş Yap
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
