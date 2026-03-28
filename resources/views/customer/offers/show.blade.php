@extends('layouts.app', ['title' => 'Teklif Detayı'])

@section('content')
    <div class="card">
        <h1>Teklif #{{ $offer->id }}</h1>
        <p class="muted">Durum: {{ $offer->status }}</p>
        <p class="muted">Firma: {{ $offer->company_name }}</p>
    </div>

    <div class="card">
        <h2>Ürün Satırları</h2>
        @forelse($offer->items as $item)
            <div style="margin-bottom:.5rem;">
                <strong>{{ $item->product?->name ?? 'Ürün bulunamadı' }}</strong>
                <div class="muted">Adet: {{ $item->quantity }} {{ $item->unit }}</div>
            </div>
        @empty
            <p class="muted">Teklifte satır bulunmuyor.</p>
        @endforelse
    </div>
@endsection
