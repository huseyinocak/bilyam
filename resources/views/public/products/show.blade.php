@extends('layouts.public')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', $product->name.' | Bilyam')
@section('meta_description', $product->technical_summary ?: $product->short_description ?: 'Teknik ürün detayı ve teklif talep ekranı.')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1.1fr)_minmax(340px,0.9fr)]">
            <div class="space-y-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex aspect-[16/10] items-center justify-center rounded-[1.5rem] bg-slate-100 text-5xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                        @if($product->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="h-full w-full rounded-[1.5rem] object-cover">
                        @else
                            {{ str($product->name)->substr(0, 2)->upper() }}
                        @endif
                    </div>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        @foreach ($product->images as $image)
                            <div class="rounded-2xl border border-slate-200 p-2 dark:border-slate-700">
                                @if(str_starts_with($image->path, 'products/'))
                                    <img src="{{ Storage::disk('public')->url($image->path) }}" alt="{{ $image->alt_text }}" class="h-32 w-full rounded-xl object-cover">
                                @else
                                    <div class="p-4 text-sm text-slate-500 dark:text-slate-400">{{ $image->alt_text }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Teknik Özellikler</h2>
                    <div class="mt-5 grid gap-3">
                        @foreach ($product->specificationValues as $specification)
                            <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm dark:bg-slate-950">
                                <span class="font-medium text-slate-600 dark:text-slate-300">{{ $specification->field?->name }}</span>
                                <span class="font-semibold text-slate-900 dark:text-white">{{ $specification->value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900 lg:sticky lg:top-24">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">{{ $product->category?->name }}</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h1>
                    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $product->description }}</p>
                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-950">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Ürün Kodu</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $product->code }}</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4 dark:bg-slate-950">
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Marka</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $product->brand?->name }}</p>
                        </div>
                    </div>
                    <div class="mt-6 rounded-2xl border border-bilya-blue/20 bg-bilya-blue/5 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-bilya-blue">Liste Fiyati</p>
                        <p class="mt-2 text-3xl font-semibold text-bilya-blue">{{ number_format((float) $product->price, 2, ',', '.') }} TL</p>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Bu fiyat bilgilendirme amaçlıdır. Toplu alım ve termin için teklif talebi oluşturabilirsiniz.</p>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-2 text-xs text-slate-500 dark:text-slate-400">
                        @foreach ($product->useCases as $useCase)
                            <span class="rounded-full border border-slate-200 px-3 py-1 dark:border-slate-700">{{ $useCase->name }}</span>
                        @endforeach
                    </div>
                    <form method="POST" action="{{ route('quote-list.store', $product) }}" class="mt-6 space-y-3">
                        @csrf
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white">Adet</label>
                        <input type="number" name="quantity" min="1" value="1" class="block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Teklif Listesine Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Benzer Ürünler</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Ayni kategoride diger secenekler</h2>
            </div>
            <a href="{{ route('products.index', ['category' => $product->category?->slug]) }}" class="text-sm font-semibold text-bilya-blue">Tümünü gör</a>
        </div>
        <div class="mt-8 grid gap-5 lg:grid-cols-4">
            @foreach ($relatedProducts as $relatedProduct)
                <a href="{{ route('products.show', $relatedProduct) }}" class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex aspect-[4/3] items-center justify-center rounded-[1.5rem] bg-slate-100 text-3xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">{{ str($relatedProduct->name)->substr(0, 2)->upper() }}</div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">{{ $relatedProduct->name }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $relatedProduct->technical_summary }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection
