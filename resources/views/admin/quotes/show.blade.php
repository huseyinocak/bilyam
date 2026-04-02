@extends('layouts.admin')

@section('title', $quote->quote_no.' | Teklif Detayı')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Teklif Detayı</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900 dark:text-white">{{ $quote->quote_no }}</h1>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">{{ $quote->company_name ?: $quote->requester_name }} • {{ $quote->requester_email }} • {{ $quote->requester_phone ?: 'Telefon yok' }}</p>
                </div>

                <form method="POST" action="{{ route('admin.quotes.status.update', $quote) }}" class="grid gap-3 sm:grid-cols-[200px_minmax(0,1fr)_auto] xl:w-[760px]">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" @selected($quote->status === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="note" placeholder="Durum notu" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <button type="submit" class="rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Durumu Güncelle</button>
                </form>
            </div>
            @error('status')
                <p class="mt-4 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </section>

        <div class="grid gap-6 xl:grid-cols-[minmax(0,1.2fr)_360px]">
            <section class="space-y-4">
                @foreach ($quote->items as $item)
                    <article class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                        <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                            <div>
                                <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $item->product_name }}</p>
                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $item->product_code }} • {{ $item->quantity }} adet</p>
                            </div>
                            @if ($item->responseItem)
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">Yanıtlandı</span>
                            @else
                                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">Bekliyor</span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('admin.quotes.items.update', [$quote, $item]) }}" class="mt-5 grid gap-4 lg:grid-cols-4">
                            @csrf
                            @method('PATCH')
                            <input type="number" step="0.01" min="0" name="unit_price" value="{{ old('unit_price', $item->responseItem?->unit_price) }}" placeholder="Birim fiyat" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                            <input type="text" name="currency" value="{{ old('currency', $item->responseItem?->currency ?? 'TRY') }}" placeholder="Para birimi" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                            <input type="text" name="lead_time" value="{{ old('lead_time', $item->responseItem?->lead_time) }}" placeholder="Termin" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                            <button type="submit" class="rounded-full bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-blue dark:bg-white dark:text-slate-900">Satiri Kaydet</button>
                            <textarea name="note" rows="3" placeholder="Satir notu" class="lg:col-span-4 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('note', $item->responseItem?->note) }}</textarea>
                        </form>
                    </article>
                @endforeach
            </section>

            <div class="space-y-6">
                <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Talep Bilgileri</h2>
                    <div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        <div class="flex items-center justify-between"><span>Durum</span><span class="font-semibold text-slate-900 dark:text-white">{{ $statuses[$quote->status] ?? $quote->status }}</span></div>
                        <div class="flex items-center justify-between"><span>Tarih</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->submitted_at?->format('d.m.Y H:i') }}</span></div>
                        <div class="flex items-center justify-between"><span>Müşteri</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->customer?->name ?: $quote->requester_name }}</span></div>
                        <div class="flex items-center justify-between"><span>Firma</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->company_name ?: '-' }}</span></div>
                        <div class="flex items-center justify-between"><span>Vergi No</span><span class="font-semibold text-slate-900 dark:text-white">{{ $quote->tax_number ?: '-' }}</span></div>
                    </div>
                    @if ($quote->note)
                        <div class="mt-4 rounded-2xl bg-slate-50 px-4 py-4 text-sm text-slate-600 dark:bg-slate-950 dark:text-slate-300">{{ $quote->note }}</div>
                    @endif
                </section>

                <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Durum Geçmişi</h2>
                    <div class="mt-4 space-y-3">
                        @foreach ($quote->statusHistories->sortByDesc('created_at') as $history)
                            <div class="rounded-2xl bg-slate-50 px-4 py-4 text-sm dark:bg-slate-950">
                                <p class="font-semibold text-slate-900 dark:text-white">{{ $history->from_status ? $history->from_status.' → ' : '' }}{{ $history->to_status }}</p>
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
@endsection
