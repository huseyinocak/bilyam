<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">
        <meta name="description" content="@yield('meta_description', 'Bilyam teknik urun katalogu, B2B teklif sureci ve endustriyel tedarik operasyonu icin modern bir platform sunar.')">
        <meta name="robots" content="@yield('meta_robots', 'index,follow')">
        <link rel="canonical" href="@yield('canonical', url()->current())">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Bilyam">
        <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', config('app.name', 'Bilyam'))))">
        <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description', 'Bilyam teknik urun katalogu, B2B teklif sureci ve endustriyel tedarik operasyonu icin modern bir platform sunar.')))">
        <meta property="og:url" content="@yield('og_url', url()->current())">
        <meta property="og:image" content="{{ asset('brand/toptanbilyalogo.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('brand/favicon.png') }}">
        <title>@yield('title', config('app.name', 'Bilyam'))</title>
        <script>
            const storedTheme = localStorage.getItem('theme');
            const useDark = storedTheme ? storedTheme === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', useDark);
        </script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body class="min-h-full bg-slate-100 text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
        @yield('body')
    </body>
</html>
