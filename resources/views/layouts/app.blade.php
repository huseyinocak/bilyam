<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">
        <meta name="description" content="Musteri paneli yalnizca teklif takibi ve hesap yonetimi icin kullanilir.">
        <meta name="robots" content="noindex,nofollow">
        <link rel="canonical" href="{{ url()->current() }}">
        <link rel="icon" type="image/png" href="{{ asset('brand/favicon.png') }}">

        <title>{{ config('app.name', 'Bilyam') }}</title>

        <script>
            const storedTheme = localStorage.getItem('theme');
            const useDark = storedTheme ? storedTheme === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', useDark);
        </script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full font-sans antialiased">
        <div class="min-h-screen bg-slate-100 dark:bg-slate-950">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-slate-200 bg-white/90 shadow-sm dark:border-slate-800 dark:bg-slate-950/90">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

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
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
