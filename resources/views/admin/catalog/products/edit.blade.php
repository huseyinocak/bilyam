@extends('layouts.admin')

@section('title', $product->name.' | Urun Duzenle')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Urunu Duzenle</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $product->name }} icin galeri, teknik degerler ve yayin ayarlarini yonetin.</p>
        </section>

        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            @include('admin.catalog.products._form', [
                'action' => route('admin.products.update', $product),
                'method' => 'PATCH',
                'submitLabel' => 'Degisiklikleri Kaydet',
            ])
        </section>
    </div>
@endsection
