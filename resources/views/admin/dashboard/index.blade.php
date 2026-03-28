@extends('layouts.app', ['title' => 'Admin Dashboard'])

@section('content')
    <div class="card">
        <h1>Admin Dashboard (Skeleton)</h1>
        <p class="muted">Operasyonel KPI özetleri.</p>
    </div>

    <div class="grid">
        <div class="card"><strong>{{ $stats['quote_total'] }}</strong><div class="muted">Toplam teklif</div></div>
        <div class="card"><strong>{{ $stats['quote_received'] }}</strong><div class="muted">Alınan teklif</div></div>
        <div class="card"><strong>{{ $stats['product_total'] }}</strong><div class="muted">Toplam ürün</div></div>
    </div>
@endsection
