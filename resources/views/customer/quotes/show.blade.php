<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Teklif Detayi</p>
                <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $quote->quote_no }}</h1>
            </div>
            <form method="POST" action="{{ route('account.quotes.reorder', $quote) }}">
                @csrf
                <button type="submit" class="rounded-full bg-bilya-blue px-4 py-2 text-sm font-semibold text-white transition hover:bg-bilya-navy">Hizli Tekrar Talep</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto grid max-w-7xl gap-6 sm:px-6 lg:grid-cols-[minmax(0,1.2fr)_360px] lg:px-8">
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Teklif Kalemleri</h2>
                <div class="mt-5 space-y-4">
                    @foreach ($quote->items as $item)
                        <article class="rounded-2xl bg-slate-50 p-5 dark:bg-slate-950">
                            <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                                <div>
                                    <p class="text-base font-semibold text-slate-900 dark:text-white">{{ $item->product_name }}</p>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $item->product_code }} • {{ $item->quantity }} adet</p>
                                </div>
                                @if ($item->responseItem)
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">Yanitlandi</span>
                                @else
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">Bekliyor</span>
                                @endif
                            </div>

                            @if ($item->responseItem)
                                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                                    <div class="rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-800">
                                        <p class="text-slate-500 dark:text-slate-400">Birim Fiyat</p>
                                        <p class="mt-2 font-semibold text-slate-900 dark:text-white">{{ number_format((float) $item->responseItem->unit_price, 2, ',', '.') }} {{ $item->responseItem->currency }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-800">
                                        <p class="text-slate-500 dark:text-slate-400">Termin</p>
                                        <p class="mt-2 font-semibold text-slate-900 dark:text-white">{{ $item->responseItem->lead_time ?: 'Belirtilmedi' }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 px-4 py-3 text-sm dark:border-slate-800">
                                        <p class="text-slate-500 dark:text-slate-400">Not</p>
                                        <p class="mt-2 font-semibold text-slate-900 dark:text-white">{{ $item->responseItem->note ?: 'Aciklama yok' }}</p>
                                    </div>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>

            <div class="space-y-6">
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Talep Ozeti</h2>
                    <div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        <div class="flex items-center justify-between"><span>Durum</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->status }}</span></div>
                        <div class="flex items-center justify-between"><span>Talep Tarihi</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->submitted_at?->format('d.m.Y H:i') }}</span></div>
                        <div class="flex items-center justify-between"><span>Firma</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->company_name ?: '-' }}</span></div>
                        <div class="flex items-center justify-between"><span>E-posta</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->requester_email }}</span></div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Durum Gecmisi</h2>
                    <div class="mt-4 space-y-3">
                        @foreach ($quote->statusHistories->sortByDesc('created_at') as $history)
                            <div class="rounded-2xl bg-slate-50 px-4 py-4 text-sm dark:bg-slate-950">
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $history->to_status }}</p>
                                <p class="mt-1 text-slate-500 dark:text-slate-400">{{ $history->created_at->format('d.m.Y H:i') }} @if($history->user) • {{ $history->user->name }} @endif</p>
                                @if ($history->note)
                                    <p class="mt-2 text-slate-600 dark:text-slate-300">{{ $history->note }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
