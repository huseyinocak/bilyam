@extends('layouts.base')

@section('body')
    <div class="min-h-screen">
        <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90">
            <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <x-application-logo class="h-11 w-auto" />
                    <div class="hidden sm:block">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Teknik Ürün Platformu</p>
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Bilyam</p>
                    </div>
                </a>
                <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 lg:flex dark:text-slate-300">
                    <a href="{{ route('home') }}#vitrin" class="transition hover:text-bilya-blue">Ana Sayfa</a>
                    <a href="{{ route('products.index') }}" class="transition hover:text-bilya-blue {{ request()->routeIs('products.*') ? 'text-bilya-blue' : '' }}">Ürünler</a>
                    <a href="{{ route('home') }}#kategoriler" class="transition hover:text-bilya-blue">Kategoriler</a>
                    <a href="{{ route('home') }}#nasil-calisir" class="transition hover:text-bilya-blue">Nasıl Çalışır</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="{{ route('quote-list.index') }}" class="relative rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">
                        Teklif Listem
                        @if(($quoteListCount ?? 0) > 0)
                            <span class="absolute -right-2 -top-2 inline-flex h-6 min-w-6 items-center justify-center rounded-full bg-bilya-blue px-1 text-xs font-bold text-white">{{ $quoteListCount }}</span>
                        @endif
                    </a>
                    <button type="button" x-data @click="localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'light' : 'dark'); document.documentElement.classList.toggle('dark')" class="rounded-full border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Tema</button>
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Giriş Yap</a>
                    @endauth
                </div>
            </div>
        </header>

        <main>
            @if (session('status'))
                <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">{{ session('status') }}</div>
                </div>
            @endif
            @if ($errors->any())
                <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-900/40 dark:bg-rose-950/40 dark:text-rose-300">{{ $errors->first() }}</div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
@endsection
