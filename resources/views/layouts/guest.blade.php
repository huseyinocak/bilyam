<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">
        <meta name="description" content="Bilyam musteri girisi ve hesap olusturma ekranlari.">
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
    <body class="min-h-full bg-slate-100 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
        <div class="grid min-h-screen lg:grid-cols-[1.05fr_minmax(0,460px)]">
            <div class="hidden bg-gradient-to-br from-bilya-navy via-slate-950 to-bilya-blue px-10 py-12 text-white lg:flex lg:flex-col lg:justify-between">
                <div class="space-y-8">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="h-12 w-auto" />
                    </a>
                    <div class="space-y-4">
                        <p class="inline-flex rounded-full border border-white/20 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80">B2B Ağırlıklı Katalog</p>
                        <h1 class="max-w-xl text-4xl font-semibold leading-tight">Teknik ürünleri keşfedin, teklif akışını tek merkezde yönetin.</h1>
                        <p class="max-w-lg text-base leading-7 text-slate-200">Bilyam, ürün keşfi ile teklif sürecini aynı akışta buluşturan kurumsal tedarik deneyimi sunar.</p>
                    </div>
                </div>
                <div class="grid gap-4 text-sm text-slate-200">
                    <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-5">Misafir teklif akışı açık, üyelik ise teklif takibini kolaylaştıran değer katmanı olarak konumlanır.</div>
                    <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-5">Kurumsal talep akışı, mobil uyum ve sade panel deneyimi aynı dilde tasarlanmıştır.</div>
                </div>
            </div>
            <div class="flex items-center justify-center px-4 py-10 sm:px-6 lg:px-10">
                <div class="w-full max-w-md">
                    <div class="mb-6 flex items-center justify-between lg:hidden">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="h-10 w-auto" />
                        </a>
                        <button type="button" x-data @click="localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'light' : 'dark'); document.documentElement.classList.toggle('dark')" class="rounded-full border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Tema</button>
                    </div>
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
