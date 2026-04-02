<x-guest-layout>
    <div class="mb-6 space-y-2">
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Müşteri Kaydı</p>
        <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Yeni hesap olusturun</h1>
        <p class="text-sm text-slate-600 dark:text-slate-300">Uyelik teklif vermek icin zorunlu degil, fakat teklif gecmisi ve tekrar talep gibi avantajlar saglar.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="'Ad Soyad'" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="'E-posta'" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Şifre'" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Şifre Tekrarı'" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bilya-blue dark:text-slate-300 dark:hover:text-white" href="{{ route('login') }}">
                Zaten hesabin var mi?
            </a>

            <x-primary-button class="ms-4">
                Kayıt Ol
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
