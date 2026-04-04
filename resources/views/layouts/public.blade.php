@extends('layouts.base')

@section('body')
    <div class="min-h-screen overflow-x-hidden" x-data="{ open: false, dark: document.documentElement.classList.contains('dark') }">
        <div class="border-b border-slate-200 bg-slate-950 text-white dark:border-slate-800">
            <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-2 text-xs font-medium sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div class="flex flex-wrap items-center gap-3 text-slate-200">
                    <span>Kurumsal teklif ve tedarik süreci</span>
                    <span class="hidden h-1 w-1 rounded-full bg-white/40 lg:inline-flex"></span>
                    <span>Çoklu ürün için tek talep akışı</span>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-slate-300">
                    <span>Katalog + Teklif + Müşteri Takibi</span>
                </div>
            </div>
        </div>
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
                    <a href="{{ route('contact.index') }}" class="transition hover:text-bilya-blue {{ request()->routeIs('contact.*') ? 'text-bilya-blue' : '' }}">İletişim</a>
                </nav>
                <div class="flex items-center gap-2 sm:gap-3">
                    <a href="{{ route('quote-list.index') }}" class="relative hidden rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200 sm:inline-flex">
                        Teklif Listem
                        @if(($quoteListCount ?? 0) > 0)
                            <span class="absolute -right-2 -top-2 inline-flex h-6 min-w-6 items-center justify-center rounded-full bg-bilya-blue px-1 text-xs font-bold text-white">{{ $quoteListCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('quote-list.index') }}" class="relative inline-flex h-11 items-center justify-center rounded-full border border-slate-300 px-4 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200 sm:hidden">
                        Teklif
                        @if(($quoteListCount ?? 0) > 0)
                            <span class="absolute -right-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-bilya-blue px-1 text-[10px] font-bold text-white">{{ $quoteListCount }}</span>
                        @endif
                    </a>
                    <button type="button" x-data @click="localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'light' : 'dark'); document.documentElement.classList.toggle('dark'); dark = document.documentElement.classList.contains('dark')" class="hidden rounded-full border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200 sm:inline-flex">Tema</button>
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200 sm:inline-flex">Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200 sm:inline-flex">Giriş Yap</a>
                    @endauth
                    <button type="button" @click="open = ! open" class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-300 text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200 lg:hidden">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="open" x-transition class="border-t border-slate-200 bg-white px-4 py-4 dark:border-slate-800 dark:bg-slate-950 lg:hidden">
                <div class="flex flex-col gap-3 text-sm font-medium text-slate-700 dark:text-slate-200">
                    <a href="{{ route('home') }}#vitrin" @click="open = false">Ana Sayfa</a>
                    <a href="{{ route('products.index') }}" @click="open = false">Ürünler</a>
                    <a href="{{ route('home') }}#kategoriler" @click="open = false">Kategoriler</a>
                    <a href="{{ route('contact.index') }}" @click="open = false">İletişim</a>
                    <a href="{{ route('quote-list.index') }}" @click="open = false">Teklif Listem</a>
                    @auth
                        <a href="{{ route('dashboard') }}" @click="open = false">Panel</a>
                    @else
                        <a href="{{ route('login') }}" @click="open = false">Giriş Yap</a>
                    @endauth
                    <button type="button" @click="localStorage.setItem('theme', dark ? 'light' : 'dark'); document.documentElement.classList.toggle('dark'); dark = !dark" class="text-left">Tema Değiştir</button>
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
