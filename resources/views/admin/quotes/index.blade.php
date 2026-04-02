@extends('layouts.admin')

@section('title', 'Teklif Talepleri | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Operasyon</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900 dark:text-white">Teklif Talepleri</h1>
                </div>
                <form method="GET" action="{{ route('admin.quotes.index') }}" class="grid gap-3 sm:grid-cols-2 xl:grid-cols-5">
                    <select name="status" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <option value="">Tum durumlar</option>
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" @selected($filters['status'] === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="company" value="{{ $filters['company'] }}" placeholder="Firma" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <input type="date" name="from" value="{{ $filters['from'] }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <input type="date" name="to" value="{{ $filters['to'] }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <button type="submit" class="rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Filtrele</button>
                </form>
            </div>
        </section>

        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <div class="space-y-3">
                @foreach ($quotes as $quote)
                    <a href="{{ route('admin.quotes.show', $quote) }}" class="flex flex-col gap-4 rounded-2xl bg-slate-50 px-5 py-4 transition hover:text-bilya-blue dark:bg-slate-950 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">{{ $quote->quote_no }}</p>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $quote->company_name ?: $quote->requester_name }} • {{ $quote->submitted_at?->format('d.m.Y H:i') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-slate-500 dark:text-slate-400">{{ $quote->items_count }} kalem</span>
                            <span class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $statuses[$quote->status] ?? $quote->status }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $quotes->links() }}
            </div>
        </section>
    </div>
@endsection
