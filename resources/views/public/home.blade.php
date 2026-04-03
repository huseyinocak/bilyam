@extends('layouts.public')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Bilyam | Endüstriyel Teknik Ürün Tedariği')
@section('meta_description', 'Rulman, filtre, kayış, burç ve sanayi tekeri gibi teknik ürünleri kategori bazlı keşfedin; çoklu ürün için tek seferde teklif oluşturun.')

@section('content')
    <section id="vitrin" class="relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[680px] bg-gradient-to-br from-bilya-navy via-slate-950 to-bilya-blue"></div>
        <div class="absolute left-0 top-24 -z-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute right-0 top-36 -z-10 h-72 w-72 rounded-full bg-bilya-blue/30 blur-3xl"></div>

        @if(($heroMode ?? 'static') === 'slider' && $heroSlides->isNotEmpty())
            @php($initialSlide = $heroSlides->first())
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24" x-data="{ active: 0, slides: {{ Js::from($heroSlides->values()) }}, next() { this.active = (this.active + 1) % this.slides.length }, prev() { this.active = (this.active - 1 + this.slides.length) % this.slides.length } }">
                <div class="grid gap-10 lg:grid-cols-[minmax(0,1.1fr)_minmax(320px,0.9fr)] lg:items-center">
                    <div class="text-white">
                        <div class="space-y-6">
                            <p class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80" x-text="slides[active].eyebrow">{{ $initialSlide['eyebrow'] }}</p>
                            <h1 class="max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl" x-text="slides[active].title">{{ $initialSlide['title'] }}</h1>
                            <p class="max-w-2xl text-base leading-8 text-slate-200" x-text="slides[active].description">{{ $initialSlide['description'] }}</p>
                            <div class="flex flex-wrap gap-3">
                                <a :href="slides[active].primary_cta_url" class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-bilya-navy transition hover:bg-slate-100" x-text="slides[active].primary_cta_label">{{ $initialSlide['primary_cta_label'] }}</a>
                                <a x-show="slides[active].secondary_cta_label" :href="slides[active].secondary_cta_url" class="rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10" x-text="slides[active].secondary_cta_label">{{ $initialSlide['secondary_cta_label'] }}</a>
                            </div>
                            <div class="flex flex-wrap gap-3">
                                <button type="button" @click="prev()" class="control-chip">Önceki</button>
                                <button type="button" @click="next()" class="control-chip">Sonraki</button>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-wrap items-center gap-3">
                            <template x-for="(slide, index) in slides" :key="'dot-' + index">
                                <button type="button" @click="active = index" class="h-3 w-10 rounded-full transition" :class="active === index ? 'bg-white' : 'bg-white/25'"></button>
                            </template>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-3">
                            @foreach ($heroStats as $stat)
                                <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/35 px-5 py-5 backdrop-blur">
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
                                    <img :src="slides[active].image" :alt="slides[active].image_alt || slides[active].title" class="h-full w-full object-cover">
                                </template>
                                <template x-if="!slides[active].image">
                                    <div class="flex h-full w-full items-center justify-center text-4xl font-semibold text-white/40" x-text="slides[active].title.substring(0, 2).toUpperCase()"></div>
                                </template>
                                @if($initialSlide['image'])
                                    <img src="{{ $initialSlide['image'] }}" alt="{{ $initialSlide['image_alt'] ?: $initialSlide['title'] }}" class="h-full w-full object-cover" x-show="!slides[active].image">
                                @endif
                                <div class="pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/80 to-transparent p-6">
                                    <p class="text-sm font-semibold text-white" x-text="slides[active].eyebrow">{{ $initialSlide['eyebrow'] }}</p>
                                    <p class="mt-2 text-2xl font-semibold text-white" x-text="slides[active].title">{{ $initialSlide['title'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[minmax(0,1.15fr)_minmax(320px,0.85fr)] lg:px-8 lg:py-24">
                <div class="space-y-8 text-white">
                    <div class="space-y-5">
                        <p class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80">{{ $staticHero['eyebrow'] }}</p>
                        <h1 class="max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">{{ $staticHero['title'] }}</h1>
                        <p class="max-w-2xl text-base leading-8 text-slate-200">{{ $staticHero['description'] }}</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $staticHero['primary_cta_url'] }}" class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-bilya-navy transition hover:bg-slate-100">{{ $staticHero['primary_cta_label'] }}</a>
                        @if(!empty($staticHero['secondary_cta_label']))
                            <a href="{{ $staticHero['secondary_cta_url'] }}" class="rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">{{ $staticHero['secondary_cta_label'] }}</a>
                        @endif
                    </div>

                    <div class="grid gap-3 sm:grid-cols-3">
                        @foreach ($staticHero['support_items'] as $badge)
                            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 text-sm font-medium text-slate-100 backdrop-blur">{{ $badge }}</div>
                        @endforeach
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        @foreach ($heroStats as $stat)
                            <div class="rounded-[1.75rem] border border-white/10 bg-slate-950/35 px-5 py-5 backdrop-blur">
                                <p class="text-3xl font-semibold text-white">{{ $stat['value'] }}</p>
                                <p class="mt-2 text-sm text-slate-300">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 text-white shadow-soft backdrop-blur">
                    <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-950/60">
                        <div class="border-b border-white/10 px-6 py-5">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Kurumsal Tedarik Akışı</p>
                            <h2 class="mt-3 text-2xl font-semibold text-white">Teklif sürecini dağınık iletişim yerine tek merkezde yönetin.</h2>
                        </div>
                        <div class="space-y-4 p-6">
                            @foreach ($staticHero['support_items'] as $index => $supportItem)
                                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="text-sm font-semibold text-white">{{ $supportItem }}</p>
                                            <p class="mt-2 text-sm leading-6 text-slate-200">Kurumsal tedarik akışınızı güçlendiren odak noktalarından biridir.</p>
                                        </div>
                                        <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/80">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <section id="kategoriler" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Ürün Kategorileri</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">İhtiyacınıza uygun teknik ürün gruplarını hızla keşfedin</h2>
            </div>
            <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Saha ekipmanlarından üretim hatlarına kadar farklı kullanım alanları için kategorilere ayrılmış ürün gruplarını inceleyin.</p>
        </div>

        <div class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="group overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex aspect-[16/10] items-center justify-center overflow-hidden bg-slate-100 dark:bg-slate-950">
                        @if($category->image_path)
                            <img src="{{ Storage::disk('public')->url($category->image_path) }}" alt="{{ $category->image_alt ?: $category->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @elseif($featuredProducts->firstWhere('category_id', $category->id)?->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($featuredProducts->firstWhere('category_id', $category->id)->primaryImage->path) }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <span class="text-4xl font-semibold text-slate-400">{{ str($category->name)->substr(0, 2)->upper() }}</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-bilya-blue">Kategori</p>
                        <h3 class="mt-3 text-xl font-semibold text-slate-900 dark:text-white">{{ $category->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $category->description }}</p>
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
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Tedarik sürecinizi hızlandıran net ve operasyonel bir yapı</h2>
                </div>
                <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Ürün keşfi, çoklu teklif oluşturma ve operasyon takibi aynı akışta buluşur. Böylece karar ve geri dönüş süreleri kısalır.</p>
            </div>

            <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($trustBlocks as $block)
                    <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 transition hover:border-bilya-blue/40 dark:border-slate-800 dark:bg-slate-950">
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
                <a href="{{ route('products.show', $product) }}" class="group rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex aspect-[4/3] items-center justify-center overflow-hidden rounded-[1.5rem] bg-slate-100 text-3xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                        @if($product->primaryImage?->path)
                            <img src="{{ Storage::disk('public')->url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            {{ str($product->name)->substr(0, 2)->upper() }}
                        @endif
                    </div>
                    <div class="mt-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $product->category?->name }}</p>
                            <h3 class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h3>
                        </div>
                        @if($product->brand)
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 dark:bg-slate-950 dark:text-slate-300">{{ $product->brand->name }}</span>
                        @endif
                    </div>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $product->technical_summary }}</p>
                    <div class="mt-4 flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 dark:bg-slate-950">
                        <span class="text-sm font-semibold text-bilya-blue">{{ number_format((float) $product->price, 2, ',', '.') }} TL</span>
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
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Teklif sürecini üç adımda tamamlayın</h2>
                </div>
                <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Ürünleri seçin, teklif listenize ekleyin ve iletişim bilgilerinizi gönderin. Operasyon ekibimiz size özel geri dönüş sağlasın.</p>
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-3">
                @foreach ($processSteps as $index => $step)
                    <article class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 dark:border-slate-800 dark:bg-slate-950">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-bilya-blue">Adım {{ $index + 1 }}</p>
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
                    <h2 class="mt-3 text-3xl font-semibold">Çoklu ürün talepleri için daha düzenli ve hızlı bir teklif deneyimi</h2>
                    <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-300">Bilyam, ürün keşfi ile teklif sürecini aynı akışta birleştirir. Böylece farklı ürün grupları için daha düzenli, izlenebilir ve hızlı bir tedarik süreci sunar.</p>
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
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Teklif Başlat</p>
                    <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">İhtiyacınız olan ürünleri inceleyin, teklif sürecini hemen başlatın</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Kataloğu keşfedin, ilgili ürünleri teklif listenize ekleyin ve operasyon ekibimizden size özel dönüş alın.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Kataloğu İncele</a>
                    <a href="{{ route('quote-list.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Teklif Listeme Git</a>
                </div>
            </div>
        </div>
    </section>
@endsection
