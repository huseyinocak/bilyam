@extends('layouts.app', ['title' => 'Müşteri Teklifleri'])

@section('content')
    <div class="card">
        <h1>Müşteri Paneli · Tekliflerim</h1>
        <p class="muted">Bu ekran müşteri teklif listesi iskeletidir.</p>
    </div>

    <div class="card">
        @forelse($offers as $offer)
            <div style="display:flex;justify-content:space-between;gap:1rem;margin-bottom:.75rem;align-items:center;">
                <div>
                    <strong>#{{ $offer->id }}</strong>
                    <div class="muted">Durum: {{ $offer->status }} · Ürün satırı: {{ $offer->items_count }}</div>
                </div>
                <a class="btn" href="{{ route('customer.offers.show', $offer) }}">Detay</a>
            </div>
        @empty
            <p class="muted">Henüz teklif kaydı bulunmuyor.</p>
        @endforelse

        <div>{{ $offers->links() }}</div>
    </div>
@endsection
