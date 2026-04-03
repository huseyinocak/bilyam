@extends('layouts.base')

@section('meta_robots', 'noindex,nofollow')

@section('body')
    <div class="min-h-screen bg-slate-100 dark:bg-slate-950 lg:grid lg:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="border-b border-slate-200 bg-slate-950 px-6 py-8 text-slate-100 dark:border-slate-800 lg:min-h-screen lg:border-b-0 lg:border-r">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <x-application-logo class="h-11 w-auto" />
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Admin Panel</p>
                    <p class="text-sm font-semibold text-white">Bilyam Operasyon</p>
                </div>
            </a>
            <div class="mt-10 space-y-8 text-sm">
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Operasyon</p>
                    <div class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Dashboard</a>
                        <a href="{{ route('admin.quotes.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.quotes.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Teklif Talepleri</a>
                    </div>
                </div>
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Katalog</p>
                    <div class="space-y-2">
                        <a href="{{ route('admin.products.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.products.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Ürünler</a>
                        <a href="{{ route('admin.categories.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Kategoriler</a>
                        <a href="{{ route('admin.brands.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.brands.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Markalar</a>
                        <a href="{{ route('admin.use-cases.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.use-cases.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Kullanım Alanları</a>
                        <a href="{{ route('admin.specification-templates.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.specification-templates.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Teknik Özellikler</a>
                    </div>
                </div>
                <div>
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Yönetim</p>
                    <div class="space-y-2">
                        <a href="{{ route('admin.users.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Kullanicilar</a>
                        <a href="{{ route('admin.roles.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.roles.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Roller</a>
                        <a href="{{ route('admin.activity-logs.index') }}" class="block rounded-2xl px-4 py-3 transition hover:bg-white/5 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-white/10 text-white' : 'text-slate-300' }}">Aktivite Loglari</a>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-10">
                @csrf
                <button type="submit" class="w-full rounded-2xl border border-white/10 px-4 py-3 text-sm font-semibold text-white transition hover:bg-white/5">Guvenli Cikis</button>
            </form>
        </aside>
        <main class="px-4 py-8 sm:px-6 lg:px-10">
            @if (session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-900/40 dark:bg-emerald-950/40 dark:text-emerald-300">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-900/40 dark:bg-rose-950/40 dark:text-rose-300">{{ $errors->first() }}</div>
            @endif
            @yield('content')
        </main>
    </div>
@endsection
