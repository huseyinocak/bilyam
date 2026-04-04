@extends('layouts.base')

@section('title', 'Admin Girişi | Bilyam')

@section('body')
    <div class="grid min-h-screen lg:grid-cols-[minmax(0,1fr)_460px]">
        <section class="hidden bg-slate-950 px-10 py-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="space-y-8">
                <a href="{{ route('home') }}">
                    <x-application-logo class="h-12 w-auto" />
                </a>
                <div class="space-y-4">
                    <p class="inline-flex rounded-full border border-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Admin Operasyon</p>
                    <h1 class="max-w-xl text-4xl font-semibold leading-tight">Teklif operasyonu, katalog kalitesi ve sistem kontrolü tek panelde.</h1>
                    <p class="max-w-lg text-sm leading-7 text-slate-300">Bu ekran yalnızca yönetim rolleri için ayrılmıştır. Müşteri hesabı ile giriş yapılsa bile admin panel erişimi verilmez.</p>
                </div>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6 text-sm leading-7 text-slate-300">Roller: super admin, admin, operation ve content manager. Yetkiler modüller bazında detaylandırılabilir.</div>
        </section>

        <section class="flex items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
            <div class="w-full max-w-md rounded-[2rem] border border-slate-200 bg-white p-8 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-8 space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Admin Girişi</p>
                    <h2 class="text-3xl font-semibold text-slate-900 dark:text-white">Yönetim paneline giriş yapın</h2>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Sadece yetkili kullanıcılar erişebilir.</p>
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <x-input-label for="email" :value="'E-posta'" />
                        <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" :value="'Şifre'" />
                        <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <label class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-300">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-bilya-blue focus:ring-bilya-blue dark:border-slate-700 dark:bg-slate-950" />
                        Beni hatirla
                    </label>
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Admin Girişi</button>
                </form>
            </div>
        </section>
    </div>
@endsection
