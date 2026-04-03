@extends('layouts.public')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', $product->name.' | Bilyam')
@section('meta_description', $product->technical_summary ?: $product->short_description ?: 'Teknik ürün detayı ve teklif talep ekranı.')

@section('content')
    <section class="soft-grid border-b border-slate-200/80 py-12 dark:border-slate-800/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="marketing-surface overflow-hidden bg-gradient-to-br from-white via-white to-slate-50 p-8 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 lg:p-10">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="eyebrow">Ürün Detayı</p>
                        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ $product->name }}</h1>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $product->technical_summary ?: $product->short_description ?: 'Teknik ürün detayı ve teklif süreci aynı sayfada sunulur.' }}</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Ürün kodu</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $product->code }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Marka</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $product->brand?->name ?: 'Belirtilmedi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1.1fr)_minmax(340px,0.9fr)]">
            <div class="space-y-6">
                <div class="marketing-surface p-6">
                    <div class="flex aspect-[16/10] items-center justify-center overflow-hidden rounded-[1.5rem] bg-slate-100 text-5xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                        @if($product->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="h-full w-full rounded-[1.5rem] object-cover">
                        @else
                            {{ str($product->name)->substr(0, 2)->upper() }}
                        @endif
                    </div>
                    <div class="mt-6 grid gap-4 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach ($product->images as $image)
                            <div class="group overflow-hidden rounded-2xl border border-slate-200 p-2 transition hover:border-bilya-blue/40 dark:border-slate-700">
                                @if(str_starts_with($image->path, 'products/'))
                                    <img src="{{ Storage::disk('public')->url($image->path) }}" alt="{{ $image->alt_text }}" class="h-28 w-full rounded-xl object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="p-4 text-sm text-slate-500 dark:text-slate-400">{{ $image->alt_text }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="marketing-surface p-6">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Teknik Özellikler</h2>
                    <div class="mt-5 grid gap-3 md:grid-cols-2">
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
                <div class="marketing-surface lg:sticky lg:top-24 p-6">
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
                    <div class="mt-6 rounded-[1.75rem] border border-bilya-blue/20 bg-gradient-to-br from-bilya-blue/5 to-white p-5 dark:to-slate-900">
                        <p class="text-xs uppercase tracking-[0.2em] text-bilya-blue">Liste Fiyatı</p>
                        <p class="mt-2 text-3xl font-semibold text-bilya-blue">{{ number_format((float) $product->price, 2, ',', '.') }} TL</p>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Bu fiyat bilgilendirme amaçlıdır. Toplu alım ve termin için teklif talebi oluşturabilirsiniz.</p>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-2 text-xs text-slate-500 dark:text-slate-400">
                        @foreach ($product->useCases as $useCase)
                            <span class="rounded-full border border-slate-200 px-3 py-1 dark:border-slate-700">{{ $useCase->name }}</span>
                        @endforeach
                    </div>
                    <form method="POST" action="{{ route('quote-list.store', $product) }}" class="mt-6 space-y-3 rounded-[1.5rem] border border-slate-200 p-4 dark:border-slate-800">
                        @csrf
                        <label class="block text-sm font-semibold text-slate-900 dark:text-white">Adet</label>
                        <input type="number" name="quantity" min="1" value="1" class="block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        <button type="submit" class="cta-primary w-full">Teklif Listesine Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Benzer Ürünler</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Aynı kategoride diğer seçenekler</h2>
            </div>
            <a href="{{ route('products.index', ['category' => $product->category?->slug]) }}" class="text-sm font-semibold text-bilya-blue">Tümünü gör</a>
        </div>
        <div class="mt-8 grid gap-5 lg:grid-cols-4">
            @foreach ($relatedProducts as $relatedProduct)
                <a href="{{ route('products.show', $relatedProduct) }}" class="marketing-surface group block p-5 hover:-translate-y-1">
                    <div class="flex aspect-[4/3] items-center justify-center overflow-hidden rounded-[1.5rem] bg-slate-100 text-3xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                        @if($relatedProduct->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($relatedProduct->primaryImage->path) }}" alt="{{ $relatedProduct->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            {{ str($relatedProduct->name)->substr(0, 2)->upper() }}
                        @endif
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">{{ $relatedProduct->name }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $relatedProduct->technical_summary }}</p>
                    @if($relatedProduct->brand)
                        <div class="mt-3 inline-flex rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $relatedProduct->brand->name }}</div>
                    @endif
                </a>
            @endforeach
        </div>
    </section>
@endsection
