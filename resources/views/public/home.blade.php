@extends('layouts.public')

@section('title', 'Bilyam | Teknik Urunler ve Teklif Platformu')
@section('meta_description', 'Endustriyel teknik urunleri kategori, kullanim alani ve urun koduna gore kesfedin; tek seferde coklu teklif talebi olusturun.')

@section('content')
    <section id="vitrin" class="relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 -z-10 h-[560px] bg-gradient-to-br from-bilya-navy via-slate-950 to-bilya-blue"></div>
        <div class="mx-auto grid max-w-7xl gap-12 px-4 py-16 sm:px-6 lg:grid-cols-[minmax(0,1.1fr)_minmax(340px,0.9fr)] lg:px-8 lg:py-24">
            <div class="space-y-8 text-white">
                <div class="space-y-4">
                    <p class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-white/80">Katalog + Teklif Operasyonu</p>
                    <h1 class="max-w-3xl text-4xl font-semibold leading-tight sm:text-5xl">Dogru teknik urunu hizla bulun, birden fazla urun icin tek seferde teklif isteyin.</h1>
                    <p class="max-w-2xl text-base leading-7 text-slate-200">Bu ilk kurulum sprinti; public site, musteri paneli ve admin paneli ayrimini hazir hale getirir. Sonraki sprintlerde katalog, teklif listesi ve operasyon modulleri bu omurgaya oturacak.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}" class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-bilya-navy transition hover:bg-slate-100">Katalogu Incele</a>
                    <a href="{{ route('admin.login') }}" class="rounded-full border border-white/20 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Admin Girisi</a>
                </div>
                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach ($adminMetrics as $metric)
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                            <p class="text-sm text-slate-300">{{ $metric['label'] }}</p>
                            <p class="mt-3 text-lg font-semibold text-white">{{ $metric['value'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 text-white shadow-soft backdrop-blur">
                <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/60 p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Sprint 1 Ciktisi</p>
                    <div class="mt-6 space-y-4">
                        @foreach ($journey as $step)
                            <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-4 text-sm leading-6 text-slate-200">{{ $step }}</div>
                        @endforeach
                    </div>
                    <div class="mt-6 rounded-2xl bg-bilya-blue/15 p-4 text-sm text-slate-200">Teklif listesi, urun vitrini ve admin teklif operasyonu sonraki sprintlerde bu yapinin uzerine eklenecek.</div>
                </div>
            </div>
        </div>
    </section>

    <section id="kapsam" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Temel Omurga</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Analiz dokumanindaki MVP icin kurulan ilk katmanlar</h2>
            </div>
            <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Ilk sprintte odak; route ayrimi, auth, roller, tema altyapisi, marka varliklari ve katalog/teklif veri modelinin cekirdek tablolaridir.</p>
        </div>
        <div class="mt-8 grid gap-5 lg:grid-cols-3">
            @foreach ($highlights as $highlight)
                <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <h3 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $highlight['title'] }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $highlight['text'] }}</p>
                </article>
            @endforeach
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-bilya-blue">Kategori</p>
                    <h3 class="mt-3 text-xl font-semibold text-slate-900 dark:text-white">{{ $category->name }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">{{ $category->description }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="akis" class="bg-white py-16 dark:bg-slate-900">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div class="rounded-[2rem] border border-slate-200 p-8 dark:border-slate-800">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Public Site</p>
                <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-white">Katalog kesfi ve teklif olusturma zemini</h3>
                <ul class="mt-6 space-y-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
                    <li>Ana sayfa vitrini ve cagirilar</li>
                    <li>Musteri ve admin alanlarina net gecis</li>
                    <li>Marka varliklari ve light/dark hazirligi</li>
                    <li>Sonraki sprintler icin katalog ve arama rotalari icin uygun omurga</li>
                </ul>
            </div>
            <div class="rounded-[2rem] border border-slate-200 p-8 dark:border-slate-800">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">Yonetim ve Musteri</p>
                <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-white">Ayrik auth ve operasyon dostu panel kurgusu</h3>
                <ul class="mt-6 space-y-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
                    <li>Musteri kayit/giris ve e-posta dogrulama yapisi</li>
                    <li>Admin icin ayri login sayfasi</li>
                    <li>Rol tabanli erisim kontrolu</li>
                    <li>Teklif, katalog ve sistem modulleri icin hazir menu iskeleti</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="yonetim" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="rounded-[2rem] border border-slate-200 bg-slate-950 p-8 text-white shadow-soft dark:border-slate-800">
            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">Sonraki Sprintler</p>
                    <h2 class="mt-3 text-3xl font-semibold">Sprint 2 ile katalog, Sprint 3 ile teklif operasyonu devreye alinacak.</h2>
                    <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-300">Bu teslim; kod tabanini paralel ajanlarla gelistirilebilir hale getiren route/modul ayrimini, temel veri modellerini ve rol tabanli erisim yapisini aktif eder.</p>
                </div>
                <div class="space-y-3 rounded-[1.5rem] border border-white/10 bg-white/5 p-5 text-sm text-slate-200">
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3"><span>Sprint 1</span><span>Kuruldu</span></div>
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3"><span>Sprint 2</span><span>Katalog + Teklif Listesi</span></div>
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3"><span>Sprint 3</span><span>Customer + Admin Operasyonu</span></div>
                    <div class="flex items-center justify-between rounded-2xl bg-white/5 px-4 py-3"><span>Sprint 4</span><span>Mail + SEO + Test</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-bilya-blue">One Cikanlar</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">Sprint 2 demo katalogu</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-bilya-blue">Tum urunleri gor</a>
        </div>

        <div class="mt-8 grid gap-5 lg:grid-cols-4">
            @foreach ($featuredProducts as $product)
                <a href="{{ route('products.show', $product) }}" class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft transition hover:-translate-y-1 dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex aspect-[4/3] items-center justify-center rounded-[1.5rem] bg-slate-100 text-3xl font-semibold text-slate-400 dark:bg-slate-950 dark:text-slate-600">
                        {{ str($product->name)->substr(0, 2)->upper() }}
                    </div>
                    <p class="mt-4 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $product->category?->name }}</p>
                    <h3 class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $product->name }}</h3>
                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $product->technical_summary }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm font-semibold text-bilya-blue">{{ number_format((float) $product->price, 2, ',', '.') }} TL</span>
                        <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Teklif</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
