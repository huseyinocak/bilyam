@extends('layouts.admin')

@section('title', 'Yeni Ürün | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Yeni Ürün</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Kataloğa yeni ürün ekleyin, ana görsel ve galeri yükleyin.</p>
        </section>

        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            @include('admin.catalog.products._form', [
                'action' => route('admin.products.store'),
                'method' => 'POST',
                'submitLabel' => 'Ürünü Oluştur',
            ])
        </section>
    </div>
@endsection
