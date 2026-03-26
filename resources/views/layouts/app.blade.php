<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Bilyam' }}</title>
    <link rel="icon" type="image/png" href="{{ route('branding.asset', ['file' => 'favicon.png']) }}">
    <style>
        body {font-family: Arial, sans-serif; margin:0; background:#0f172a; color:#e2e8f0;}
        a {color:#38bdf8; text-decoration:none;}
        .container {max-width:1100px; margin:0 auto; padding:1rem;}
        .header {display:flex; gap:1rem; align-items:center; justify-content:space-between; margin-bottom:1rem;}
        .logo {height:48px;}
        .card {background:#1e293b; border-radius:12px; padding:1rem; margin-bottom:1rem;}
        .grid {display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:1rem;}
        .btn {display:inline-block; padding:.5rem .75rem; border-radius:.5rem; border:0; background:#0ea5e9; color:#001018; font-weight:700; cursor:pointer;}
        .btn-danger {background:#ef4444; color:white;}
        .input {width:100%; padding:.55rem; border-radius:.5rem; border:1px solid #334155; background:#0b1220; color:#fff;}
        .muted {color:#94a3b8; font-size:.9rem;}
        .alert {background:#065f46; color:#ecfdf5; border-radius:10px; padding:.75rem; margin-bottom:1rem;}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <a href="{{ route('catalog.index') }}"><img src="{{ route('branding.asset', ['file' => 'toptanbilyalogo.png']) }}" alt="Logo" class="logo"></a>
        <div>
            <a href="{{ route('catalog.index') }}">{{ __('catalog.menu_products') }}</a>
            |
            <a href="{{ route('quote.list') }}">{{ __('catalog.menu_quote_list') }}</a>
            |
            <a href="{{ route('locale.switch', ['locale' => 'tr']) }}">TR</a>
            <a href="{{ route('locale.switch', ['locale' => 'en']) }}">EN</a>
        </div>
    </div>

    @if(session('status'))
        <div class="alert">{{ session('status') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
