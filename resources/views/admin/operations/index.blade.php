@extends('layouts.app', ['title' => 'Admin Operasyonlar'])

@section('content')
    <div class="card">
        <h1>Teklif Operasyon Listesi (Placeholder)</h1>
        <p class="muted">CRUD ötesi operasyon ekranı iskeleti.</p>
    </div>

    <div class="card">
        @forelse($quoteRequests as $quote)
            <div style="display:flex;justify-content:space-between;gap:1rem;margin-bottom:.75rem;align-items:center;">
                <div>
                    <strong>#{{ $quote->id }} · {{ $quote->company_name }}</strong>
                    <div class="muted">Durum: {{ $quote->status }} · Satır: {{ $quote->items_count }}</div>
                </div>
                <span class="muted">{{ $quote->created_at?->format('Y-m-d H:i') }}</span>
            </div>
        @empty
            <p class="muted">Operasyon listesinde kayıt bulunmuyor.</p>
        @endforelse

        <div>{{ $quoteRequests->links() }}</div>
    </div>
@endsection
