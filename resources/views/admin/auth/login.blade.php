@extends('layouts.base')

@section('title', 'Admin Girisi | Bilyam')

@section('body')
    <div class="grid min-h-screen lg:grid-cols-[minmax(0,1fr)_460px]">
        <section class="hidden bg-slate-950 px-10 py-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="space-y-8">
                <a href="{{ route('home') }}">
                    <x-application-logo class="h-12 w-auto" />
                </a>
                <div class="space-y-4">
                    <p class="inline-flex rounded-full border border-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Admin Operasyon</p>
                    <h1 class="max-w-xl text-4xl font-semibold leading-tight">Teklif operasyonu, katalog kalitesi ve sistem kontrolu tek panelde.</h1>
                    <p class="max-w-lg text-sm leading-7 text-slate-300">Bu ekran yalnizca yonetim rolleri icin ayrilmistir. Musteri hesabi ile giris yapilsa bile admin panel erisimi verilmez.</p>
                </div>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6 text-sm leading-7 text-slate-300">Roller: super admin, admin, operation ve content manager. Yetkiler Sprint 2 sonrasinda moduller bazinda detaylandirilacak.</div>
        </section>

        <section class="flex items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
            <div class="w-full max-w-md rounded-[2rem] border border-slate-200 bg-white p-8 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <div class="mb-8 space-y-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Admin Girisi</p>
                    <h2 class="text-3xl font-semibold text-slate-900 dark:text-white">Yonetim paneline giris yapin</h2>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Sadece yetkili kullanicilar erisebilir.</p>
                </div>

                <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <x-input-label for="email" :value="'E-posta'" />
                        <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" :value="'Sifre'" />
                        <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <label class="flex items-center gap-3 text-sm text-slate-600 dark:text-slate-300">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-bilya-blue focus:ring-bilya-blue dark:border-slate-700 dark:bg-slate-950" />
                        Beni hatirla
                    </label>
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Admin Girisi</button>
                </form>
            </div>
        </section>
    </div>
@endsection
