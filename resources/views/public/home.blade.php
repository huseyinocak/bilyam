@extends('layouts.public')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Bilyam | Endüstriyel Teknik Ürün Tedariği')
@section('meta_description',
    'Rulman, filtre, kayış, burç ve sanayi tekeri gibi teknik ürünleri kategori bazlı keşfedin;
    çoklu ürün için tek seferde teklif oluşturun.')

@section('content')
    <section id="vitrin" class="relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[720px] bg-gradient-to-br from-[#a552c2] via-[#507dc4] to-[#87aefc]">
        </div>
        <div class="absolute left-[8%] top-20 -z-10 h-72 w-72 rounded-full bg-white/16 blur-3xl"></div>
        <div class="absolute right-[10%] top-28 -z-10 h-80 w-80 rounded-full bg-sky-200/28 blur-3xl"></div>
        <div class="absolute inset-x-0 bottom-0 -z-10 h-40 bg-gradient-to-t from-slate-950/8 to-transparent"></div>

        @if (($heroMode ?? 'static') === 'slider' && $heroSlides->isNotEmpty())
            @php($initialSlide = $heroSlides->first())
            <div class="mx-auto flex min-h-[calc(100svh-105px)] max-w-7xl items-center px-4 py-12 sm:px-6 lg:px-8 lg:py-16" x-data="{ active: 0, slides: {{ Js::from($heroSlides->values()) }}, next() { this.active = (this.active + 1) % this.slides.length }, prev() { this.active = (this.active - 1 + this.slides.length) % this.slides.length } }">
                <div class="grid gap-10 lg:grid-cols-[minmax(0,1.1fr)_minmax(320px,0.9fr)] lg:items-center">
                    <div class="text-white">
                        <div class="space-y-6">
                            <p class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80"
                                x-text="slides[active].eyebrow">{{ $initialSlide['eyebrow'] }}</p>
                            <h1 class="max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl"
                                x-text="slides[active].title">{{ $initialSlide['title'] }}</h1>
                            <p class="max-w-2xl text-base leading-8 text-slate-200" x-text="slides[active].description">
                                {{ $initialSlide['description'] }}</p>
                            <div class="flex flex-wrap gap-3">
                                <a :href="slides[active].primary_cta_url"
                                    class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-bilya-navy transition hover:bg-slate-100"
                                    x-text="slides[active].primary_cta_label">{{ $initialSlide['primary_cta_label'] }}</a>
                                <a x-show="slides[active].secondary_cta_label" :href="slides[active].secondary_cta_url"
                                    class="rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10"
                                    x-text="slides[active].secondary_cta_label">{{ $initialSlide['secondary_cta_label'] }}</a>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <button type="button" @click="prev()" class="control-chip">Önceki</button>
                                <button type="button" @click="next()" class="control-chip">Sonraki</button>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <template x-for="(slide, index) in slides" :key="'dot-' + index">
                                <button type="button" @click="active = index" class="h-3 w-10 rounded-full transition"
                                    :class="active === index ? 'bg-white' : 'bg-white/25'"></button>
                            </template>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-3">
                            @foreach ($heroStats as $stat)
                                <div
                                    class="rounded-[1.75rem] border border-white/10 bg-slate-950/35 px-5 py-5 backdrop-blur">
                                    <p class="text-3xl font-semibold text-white">{{ $stat['value'] }}</p>
                                    <p class="mt-2 text-sm text-slate-300">{{ $stat['label'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 text-white shadow-soft backdrop-blur">
                        <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-950/60 p-4">
                            <div class="relative aspect-[4/3] overflow-hidden rounded-[1.25rem] bg-slate-900/80">
                                <template x-if="slides[active].image">
                                    <img :src="slides[active].image" :alt="slides[active].image_alt || slides[active].title"
                                        class="h-full w-full object-cover">
                                </template>
                                <template x-if="!slides[active].image">
                                    <div class="flex h-full w-full items-center justify-center text-4xl font-semibold text-white/40"
                                        x-text="slides[active].title.substring(0, 2).toUpperCase()"></div>
                                </template>
                                @if ($initialSlide['image'])
                                    <img src="{{ $initialSlide['image'] }}"
                                        alt="{{ $initialSlide['image_alt'] ?: $initialSlide['title'] }}"
                                        class="h-full w-full object-cover" x-show="!slides[active].image">
                                @endif
                                <div
                                    class="pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/80 to-transparent p-6">
                                    <p class="text-sm font-semibold text-white" x-text="slides[active].eyebrow">
                                        {{ $initialSlide['eyebrow'] }}</p>
                                    <p class="mt-2 text-2xl font-semibold text-white" x-text="slides[active].title">
                                        {{ $initialSlide['title'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div
                class="mx-auto flex max-w-7xl items-start px-4 pt-8 pb-6 sm:px-6 sm:pt-10 sm:pb-8 lg:min-h-[calc(100svh-105px)] lg:items-center lg:px-8 lg:pt-12 lg:pb-3">
                <div class="grid w-full gap-8 lg:grid-cols-[minmax(0,1fr)_430px] lg:items-center">
                    <div class="mx-auto max-w-2xl space-y-6 text-center text-white sm:space-y-8 lg:mx-0 lg:max-w-none lg:text-left">
                        <div class="space-y-5">
                            <p
                                class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80 shadow-[0_0_0_1px_rgba(255,255,255,0.04)]">
                                {{ $staticHero['eyebrow'] }}</p>
                            <h1 class="max-w-3xl text-[2.35rem] font-semibold leading-[1.04] sm:text-[3.35rem] lg:text-[4.5rem]">
                                {{ $staticHero['title'] }}</h1>
                            <p class="max-w-xl text-[0.95rem] leading-7 text-slate-200/95 sm:text-base sm:leading-8 lg:max-w-xl">{{ $staticHero['description'] }}</p>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2 lg:flex lg:flex-wrap">
                            <a href="{{ $staticHero['primary_cta_url'] }}"
                                class="rounded-full bg-white px-5 py-3 text-center text-sm font-semibold text-bilya-navy transition hover:bg-slate-100">{{ $staticHero['primary_cta_label'] }}</a>
                            @if (!empty($staticHero['secondary_cta_label']))
                                <a href="{{ $staticHero['secondary_cta_url'] }}"
                                    class="rounded-full border border-white/20 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-white/10">{{ $staticHero['secondary_cta_label'] }}</a>
                            @endif
                        </div>

                        <div class="flex justify-center pt-1 lg:hidden">
                            <a href="#kategoriler" class="text-white/85 transition hover:text-white">
                                <span class="flex h-10 w-6 items-start justify-center rounded-full border border-white/25 bg-white/10 p-1.5 backdrop-blur">
                                    <span class="mt-0.5 h-2 w-2 animate-bounce rounded-full bg-white/90"></span>
                                </span>
                            </a>
                        </div>

                    </div>

                    <div class="mx-auto hidden w-full max-w-[320px] pt-2 sm:max-w-[430px] sm:pt-3 lg:block lg:pt-5">
                        <div
                            class="relative rounded-[2rem] border border-white/10 bg-white/8 p-3.5 pt-12 backdrop-blur-2xl shadow-[0_24px_80px_-36px_rgba(15,23,42,0.8)] sm:rounded-[2.25rem] sm:p-6 sm:pt-20">
                            <div
                                class="absolute left-1/2 top-0 flex h-16 w-16 -translate-x-1/2 -translate-y-[46%] items-center justify-center rounded-[1.35rem] border border-white/20 bg-white/10 backdrop-blur-xl shadow-[0_24px_70px_-28px_rgba(15,23,42,0.35)] sm:h-28 sm:w-28 sm:-translate-y-[52%] sm:rounded-[2.2rem]">
                                <img src="{{ asset('brand/favicon.png') }}" alt="Bilyam favicon"
                                    class="h-9 w-9 object-contain drop-shadow-[0_14px_24px_rgba(15,23,42,0.18)] sm:h-20 sm:w-20">
                            </div>

                            <div class="grid gap-2.5 sm:grid-cols-2 sm:gap-4">
                                <div
                                    class="flex min-h-[104px] flex-col items-center justify-center rounded-[1.35rem] border border-white/10 bg-white/10 p-4 text-center text-white shadow-[0_24px_80px_-36px_rgba(15,23,42,0.8)] sm:min-h-[176px] sm:rounded-[2rem] sm:p-6 sm:col-span-2">
                                    <p class="text-[2rem] font-semibold leading-none sm:text-5xl">{{ $heroStats[0]['value'] }}</p>
                                    <p class="mt-1.5 text-xs font-medium leading-5 text-slate-200 sm:mt-3 sm:text-base sm:leading-6">{{ $heroStats[0]['label'] }}</p>
                                </div>
                                <div
                                    class="flex min-h-[98px] flex-col items-center justify-center rounded-[1.35rem] border border-white/10 bg-white/8 p-4 text-center text-white shadow-[0_24px_80px_-36px_rgba(15,23,42,0.8)] sm:min-h-[176px] sm:rounded-[2rem] sm:p-6 sm:translate-y-2">
                                    <p class="text-[2rem] font-semibold leading-none sm:text-5xl">{{ $heroStats[1]['value'] }}</p>
                                    <p class="mt-1.5 text-xs font-medium leading-5 text-slate-200 sm:mt-3 sm:text-base sm:leading-6">{{ $heroStats[1]['label'] }}</p>
                                </div>
                                <div
                                    class="flex min-h-[98px] flex-col items-center justify-center rounded-[1.35rem] border border-white/10 bg-white/8 p-4 text-center text-white shadow-[0_24px_80px_-36px_rgba(15,23,42,0.8)] sm:min-h-[176px] sm:rounded-[2rem] sm:p-6 sm:-translate-y-2">
                                    <p class="text-[2rem] font-semibold leading-none sm:text-5xl">{{ $heroStats[2]['value'] }}</p>
                                    <p class="mt-1.5 text-xs font-medium leading-5 text-slate-200 sm:mt-3 sm:text-base sm:leading-6">{{ $heroStats[2]['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (($heroMode ?? 'static') === 'static')
            <a href="#kategoriler"
                class="absolute bottom-4 left-1/2 z-10 hidden -translate-x-1/2 text-white/85 transition hover:text-white lg:block">
                <span
                    class="flex h-12 w-7 items-start justify-center rounded-full border border-white/25 bg-white/10 p-2 backdrop-blur">
                    <span class="mt-0.5 h-2.5 w-2.5 animate-bounce rounded-full bg-white/90"></span>
                </span>
            </a>
        @endif
    </section>

    <section id="kategoriler" class="mx-auto max-w-7xl px-4 pt-6 pb-16 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Ürün Kategorileri</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">İhtiyacınıza uygun teknik ürün
                    gruplarını hızla keşfedin</h2>
            </div>
            <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Saha ekipmanlarından üretim hatlarına
                kadar farklı kullanım alanları için kategorilere ayrılmış ürün gruplarını inceleyin.</p>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                    class="group overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <div
                        class="flex aspect-[16/10] items-center justify-center overflow-hidden bg-slate-100 dark:bg-slate-950">
                        @if ($category->image_path)
                            <img src="{{ Storage::disk('public')->url($category->image_path) }}"
                                alt="{{ $category->image_alt ?: $category->name }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @elseif($featuredProducts->firstWhere('category_id', $category->id)?->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($featuredProducts->firstWhere('category_id', $category->id)->primaryImage->path) }}"
                                alt="{{ $category->name }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <span
                                class="text-4xl font-semibold text-slate-400">{{ str($category->name)->substr(0, 2)->upper() }}</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-bilya-blue">Kategori</p>
                        <h3 class="mt-3 text-xl font-semibold text-slate-900 dark:text-white">{{ $category->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $category->description }}
                        </p>
                        <span class="mt-5 inline-flex text-sm font-semibold text-bilya-blue">İncele</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="bg-white py-16 dark:bg-slate-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Neden Bilyam</p>
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Tedarik sürecinizi hızlandıran
                        net ve operasyonel bir yapı</h2>
                </div>
                <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Ürün keşfi, çoklu teklif
                    oluşturma ve operasyon takibi aynı akışta buluşur. Böylece karar ve geri dönüş süreleri kısalır.</p>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($trustBlocks as $block)
                    <article
                        class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 transition hover:border-bilya-blue/40 dark:border-slate-800 dark:bg-slate-950">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $block['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $block['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Öne Çıkan Ürünler</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Sık talep edilen teknik ürünler</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-bilya-blue">Tüm ürünleri gör</a>
        </div>

        <div class="mt-8 grid gap-5 lg:grid-cols-4">
            @foreach ($featuredProducts as $product)
                <a href="{{ route('products.show', $product) }}"
                    class="group rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <div
                        class="flex aspect-[4/3] items-center justify-center overflow-hidden rounded-[1.5rem] bg-slate-100 text-3xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                        @if ($product->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            {{ str($product->name)->substr(0, 2)->upper() }}
                        @endif
                    </div>
                    <div class="mt-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                {{ $product->category?->name }}</p>
                            <h3 class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $product->name }}
                            </h3>
                        </div>
                        @if ($product->brand)
                            <span
                                class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-950 dark:text-slate-300">{{ $product->brand->name }}</span>
                        @endif
                    </div>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $product->technical_summary }}</p>
                    <div
                        class="mt-4 flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 dark:bg-slate-950">
                        <span
                            class="text-sm font-semibold text-bilya-blue">{{ number_format((float) $product->price, 2, ',', '.') }}
                            TL</span>
                        <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Teklif</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section id="nasil-calisir" class="bg-white py-16 dark:bg-slate-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Nasıl Çalışır</p>
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Teklif sürecini üç adımda
                        tamamlayın</h2>
                </div>
                <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Ürünleri seçin, teklif listenize
                    ekleyin ve iletişim bilgilerinizi gönderin. Operasyon ekibimiz size özel geri dönüş sağlasın.</p>
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-3">
                @foreach ($processSteps as $index => $step)
                    <article
                        class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 dark:border-slate-800 dark:bg-slate-950">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-bilya-blue">Adım
                            {{ $index + 1 }}</p>
                        <h3 class="mt-3 text-xl font-semibold text-slate-900 dark:text-white">{{ $step['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $step['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] border border-slate-200 bg-slate-950 p-8 text-white shadow-soft dark:border-slate-800">
            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_340px] lg:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">Kurumsal Süreç</p>
                    <h2 class="mt-3 text-3xl font-semibold">Çoklu ürün talepleri için daha düzenli ve hızlı bir teklif
                        deneyimi</h2>
                    <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-300">Bilyam, ürün keşfi ile teklif sürecini aynı
                        akışta birleştirir. Böylece farklı ürün grupları için daha düzenli, izlenebilir ve hızlı bir tedarik
                        süreci sunar.</p>
                </div>
                <div class="space-y-3 rounded-[1.5rem] border border-white/10 bg-white/5 p-5 text-sm text-slate-200">
                    @foreach ($supplyBenefits as $benefit)
                        <div class="rounded-2xl bg-white/5 px-4 py-3">{{ $benefit }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
        <div
            class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Teklif Başlat</p>
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">İhtiyacınız olan ürünleri
                        inceleyin, teklif sürecini hemen başlatın</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Kataloğu keşfedin,
                        ilgili ürünleri teklif listenize ekleyin ve operasyon ekibimizden size özel dönüş alın.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}"
                        class="rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Kataloğu
                        İncele</a>
                    <a href="{{ route('quote-list.index') }}"
                        class="rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Teklif
                        Listeme Git</a>
                </div>
            </div>
        </div>
    </section>
@endsection
