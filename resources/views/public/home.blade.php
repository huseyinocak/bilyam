@extends('layouts.public')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('title', 'Bilyam | Endüstriyel Teknik Ürün Tedariği')
@section('meta_description', 'Rulman, filtre, kayış, burç ve sanayi tekeri gibi teknik ürünleri kategori bazlı keşfedin; çoklu ürün için tek seferde teklif oluşturun.')

@section('content')
    <section id="vitrin" class="relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[680px] bg-gradient-to-br from-bilya-navy via-slate-950 to-bilya-blue"></div>
        <div class="absolute left-0 top-24 -z-10 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute right-0 top-36 -z-10 h-72 w-72 rounded-full bg-bilya-blue/30 blur-3xl"></div>
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[minmax(0,1.15fr)_minmax(320px,0.85fr)] lg:px-8 lg:py-24">
            <div class="space-y-8 text-white">
                <div class="space-y-5">
                    <p class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80">Endüstriyel Teknik Ürün Tedariği</p>
                    <h1 class="max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">Doğru rulman ve teknik ürünleri hızla bulun, teklifinizi kısa sürede alın.</h1>
                    <p class="max-w-2xl text-base leading-8 text-slate-200">Taş ocağı, konkasör, tarım makineleri, filtre, sanayi tekeri ve yardımcı ürün gruplarında geniş katalog, hızlı teklif ve güvenilir operasyon akışı.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-bilya-navy transition hover:bg-slate-100">Kataloğu İncele</a>
                    <a href="{{ route('quote-list.index') }}" class="rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Teklif Oluştur</a>
                </div>

                <div class="grid gap-3 sm:grid-cols-3">
                    @foreach ($heroBadges as $badge)
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
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-white">Kategori bazlı ürün keşfi</p>
                                    <p class="mt-2 text-sm leading-6 text-slate-200">İhtiyacınıza uygun ürün gruplarına kategori ve kullanım alanı bazlı hızla ulaşın.</p>
                                </div>
                                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/80">01</span>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-white">Tek seferde çoklu teklif talebi</p>
                                    <p class="mt-2 text-sm leading-6 text-slate-200">Birden fazla ürünü aynı listede toplayın, operasyonel süreci hızlandırın.</p>
                                </div>
                                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/80">02</span>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-white">Takip edilebilir operasyon</p>
                                    <p class="mt-2 text-sm leading-6 text-slate-200">Müşteri paneli ve teklif detayları ile sürecinizi daha kontrollü yönetin.</p>
                                </div>
                                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white/80">03</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        @if(!empty($categoryVisuals[$category->slug]))
                            <img src="{{ url($categoryVisuals[$category->slug]) }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
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
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-bilya-blue">Adim {{ $index + 1 }}</p>
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
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">Kurumsal Surec</p>
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
