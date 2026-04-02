@extends('layouts.admin')

@section('title', 'Admin Dashboard | Bilyam')

@section('content')
    <div class="space-y-8">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Operasyon Ozeti</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900 dark:text-white">Teklif operasyonu icin hazir admin omurgasi</h1>
                </div>
                <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Sprint 1 bu paneli iskelet halinde ayirir. Sprint 3 ile teklif talepleri, satir bazli fiyatlama ve katalog kalite sinyalleri baglanacak.</p>
            </div>
        </section>

        <section class="grid gap-5 lg:grid-cols-3">
            @foreach ($stats as $stat)
                <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $stat['label'] }}</p>
                    <p class="mt-3 text-4xl font-semibold text-slate-900 dark:text-white">{{ $stat['value'] }}</p>
                </article>
            @endforeach
        </section>

        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.2fr)_380px]">
            <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Sprint 1 Hazirlanan Moduller</h2>
                <div class="mt-4 grid gap-3 text-sm text-slate-600 dark:text-slate-300">
                    <div class="rounded-2xl bg-slate-50 px-4 py-4 dark:bg-slate-950">Admin login sayfasi ve yetki kontrolu</div>
                    <div class="rounded-2xl bg-slate-50 px-4 py-4 dark:bg-slate-950">Role tabanli kullanici omurgasi</div>
                    <div class="rounded-2xl bg-slate-50 px-4 py-4 dark:bg-slate-950">Katalog, teklif ve sistem tablolari</div>
                    <div class="rounded-2xl bg-slate-50 px-4 py-4 dark:bg-slate-950">Public ve musteri panelleriyle ayrik route yapisi</div>
                </div>
            </article>
            <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Sonraki Baglantilar</h2>
                <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-600 dark:text-slate-300">
                    <li>Teklif listesi ve detay ekranlari</li>
                    <li>Kategori, marka ve urun CRUD modulleri</li>
                    <li>Durum dagilimi ve son hareketler</li>
                    <li>Kalite ve eksik veri sinyalleri</li>
                </ul>
            </article>
        </section>

        @if ($latestQuotes->isNotEmpty())
            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between gap-4">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Son Teklif Hareketleri</h2>
                    <a href="{{ route('admin.quotes.index') }}" class="text-sm font-semibold text-bilya-blue">Tum teklifleri gor</a>
                </div>
                <div class="mt-4 space-y-3">
                    @foreach ($latestQuotes as $quote)
                        <a href="{{ route('admin.quotes.show', $quote) }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-4 text-sm transition hover:text-bilya-blue dark:bg-slate-950">
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $quote->quote_no }}</p>
                                <p class="mt-1 text-slate-500 dark:text-slate-400">{{ $quote->company_name ?: $quote->requester_name }}</p>
                            </div>
                            <span class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $quote->status }}</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
