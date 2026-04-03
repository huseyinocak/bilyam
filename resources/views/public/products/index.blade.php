@extends('layouts.public')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Ürünler | Bilyam')
@section('meta_description', 'Bilyam kataloğunda rulman, filtre, burç, sanayi tekeri ve farklı endüstriyel ürünleri filtreleyerek inceleyin.')
@section('canonical', request()->fullUrl())

@section('content')
    <section class="soft-grid border-b border-slate-200/80 py-12 dark:border-slate-800/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="marketing-surface overflow-hidden bg-gradient-to-br from-white via-white to-slate-50 p-8 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 lg:p-10">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="eyebrow">Ürün Vitrini</p>
                        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-slate-900 dark:text-white">Teknik ürünleri filtreleyin, karşılaştırın ve teklif listenize hızla ekleyin.</h1>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">Kategori, marka, kullanım alanı ve teknik değerler üzerinden arama yapın. İhtiyacınıza uygun ürünleri tek listede toplayıp teklif sürecini başlatın.</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-3">
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Toplam ürün</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">{{ $products->total() }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Aktif filtre</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">{{ collect([$selectedCategory, $selectedBrand, $selectedUseCase])->filter()->count() + $specificationFilters->count() }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Teklif akışı</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">3 adım</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[320px_minmax(0,1fr)]">
            <aside class="marketing-surface sticky top-24 h-fit p-6">
                <p class="eyebrow">Katalog Filtresi</p>
                <form method="GET" action="{{ route('products.index') }}" class="mt-6 space-y-5">
                    <div>
                        <label for="q" class="text-sm font-semibold text-slate-900 dark:text-white">Arama</label>
                        <input id="q" type="text" name="q" value="{{ $search }}" placeholder="Ürün adı, kategori, kod" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    </div>
                    <div>
                        <label for="category" class="text-sm font-semibold text-slate-900 dark:text-white">Kategori</label>
                        <select id="category" name="category" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                            <option value="">Tüm kategoriler</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" @selected($selectedCategory === $category->slug)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="brand" class="text-sm font-semibold text-slate-900 dark:text-white">Marka</label>
                        <select id="brand" name="brand" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                            <option value="">Tüm markalar</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}" @selected($selectedBrand === $brand->slug)>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="use_case" class="text-sm font-semibold text-slate-900 dark:text-white">Kullanım Alanı</label>
                        <select id="use_case" name="use_case" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                            <option value="">Tüm kullanım alanları</option>
                            @foreach ($useCases as $useCase)
                                <option value="{{ $useCase->slug }}" @selected($selectedUseCase === $useCase->slug)>{{ $useCase->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($filterFields->isNotEmpty())
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Teknik Filtreler</p>
                            <div class="mt-4 space-y-4">
                                @foreach($filterFields as $filter)
                                    <div>
                                        <label for="spec_{{ $filter['field']->id }}" class="text-sm font-semibold text-slate-900 dark:text-white">{{ $filter['field']->name }}</label>
                                        <select id="spec_{{ $filter['field']->id }}" name="spec[{{ $filter['field']->id }}]" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                                            <option value="">Tüm değerler</option>
                                            @foreach($filter['values'] as $value)
                                                <option value="{{ $value }}" @selected(($specificationFilters[$filter['field']->id] ?? null) === $value)>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif($selectedCategory)
                        <div class="rounded-2xl border border-dashed border-slate-300 px-4 py-4 text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">Bu kategori için filtrelenebilir teknik alan tanımlı değil.</div>
                    @endif
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                        <button type="submit" class="cta-primary">Filtreyi Uygula</button>
                        <a href="{{ route('products.index') }}" class="cta-secondary">Temizle</a>
                    </div>
                </form>
            </aside>

            <div class="space-y-6">
                <div class="marketing-surface flex flex-col gap-4 p-6 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="eyebrow">Sonuçlar</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">Teknik ürün kataloğu</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Liste, teknik seçim ve teklif süreci için sadeleştirilmiş bir ticari vitrin olarak çalışır.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-100 px-4 py-3 text-sm text-slate-600 dark:bg-slate-950 dark:text-slate-300">{{ $products->total() }} ürün bulundu</div>
                </div>

                @if ($products->count() === 0)
                    <div class="marketing-surface border-dashed p-10 text-center text-sm text-slate-500 dark:text-slate-400">Seçilen filtrelerle eşleşen ürün bulunamadı. Farklı bir arama veya filtre deneyin.</div>
                @else
                    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($products as $product)
                            <article class="marketing-surface overflow-hidden p-5 hover:-translate-y-1">
                                <a href="{{ route('products.show', $product) }}" class="group block">
                                    <div class="flex aspect-[4/3] items-center justify-center overflow-hidden rounded-[1.5rem] bg-slate-100 text-3xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                                        @if($product->primaryImage?->path)
                                            <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="h-full w-full rounded-[1.5rem] object-cover transition duration-500 group-hover:scale-105">
                                        @else
                                            {{ str($product->name)->substr(0, 2)->upper() }}
                                        @endif
                                    </div>
                                    <div class="mt-4 flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $product->category?->name }}</p>
                                            <h2 class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h2>
                                        </div>
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-950 dark:text-slate-300">{{ $product->code }}</span>
                                    </div>
                                    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $product->technical_summary }}</p>
                                    @if($product->brand)
                                        <div class="mt-3 inline-flex rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $product->brand->name }}</div>
                                    @endif
                                    <div class="mt-4 flex flex-wrap gap-2 text-xs text-slate-500 dark:text-slate-400">
                                        @foreach ($product->useCases->take(2) as $useCase)
                                            <span class="rounded-full border border-slate-200 px-3 py-1 dark:border-slate-700">{{ $useCase->name }}</span>
                                        @endforeach
                                    </div>
                                </a>
                                <div class="mt-5 flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Liste Fiyatı</p>
                                        <p class="text-lg font-semibold text-bilya-blue">{{ number_format((float) $product->price, 2, ',', '.') }} TL</p>
                                    </div>
                                    <form method="POST" action="{{ route('quote-list.store', $product) }}">
                                        @csrf
                                        <button type="submit" class="cta-primary px-4 py-2">Teklif Listesine Ekle</button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif

                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
