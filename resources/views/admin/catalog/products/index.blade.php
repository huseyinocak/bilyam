@extends('layouts.admin')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Ürünler | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Ürünler</h1>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Ürünleri listeleyin, filtreleyin ve düzenleme ekranına geçin.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <form method="GET" action="{{ route('admin.products.index') }}">
                        <input type="text" name="q" value="{{ $search }}" placeholder="Ürün adı veya kod" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    </form>
                    <a href="{{ route('admin.products.create') }}" class="rounded-full bg-bilya-blue px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-bilya-navy">Yeni Ürün</a>
                </div>
            </div>
        </section>

        <section class="space-y-4">
            @forelse($products as $product)
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="flex gap-4">
                            <div class="flex h-24 w-24 items-center justify-center overflow-hidden rounded-2xl bg-slate-100 text-2xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                                @if($product->primaryImage?->path)
                                    <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                @else
                                    {{ str($product->name)->substr(0, 2)->upper() }}
                                @endif
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $product->category?->name }}</p>
                                <h2 class="mt-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h2>
                                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $product->code }} @if($product->brand) • {{ $product->brand->name }} @endif</p>
                                <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">{{ $product->technical_summary ?: $product->short_description ?: 'Teknik ozet girilmemis.' }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-start gap-3 sm:flex-row sm:items-center">
                            <span class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $product->images->count() }} görsel</span>
                            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Düzenle</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600">Sil</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center text-sm text-slate-500 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400">Aradığınız kriterlere uygun ürün yok.</div>
            @endforelse

            <div>{{ $products->links() }}</div>
        </section>
    </div>
@endsection
