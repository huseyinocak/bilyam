<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Müşteri Paneli</p>
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Tekliflerim</h1>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <form method="GET" action="{{ route('account.quotes.index') }}" class="grid gap-4 lg:grid-cols-5">
                    <input type="text" name="quote_no" value="{{ $filters['quoteNo'] }}" placeholder="Teklif no" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <select name="status" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        <option value="">Tüm durumlar</option>
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" @selected($filters['status'] === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="from" value="{{ $filters['from'] }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <input type="date" name="to" value="{{ $filters['to'] }}" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                    <button type="submit" class="rounded-full bg-bilya-blue px-4 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Filtrele</button>
                </form>
            </section>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                @if ($quotes->count() === 0)
                    <div class="rounded-2xl border border-dashed border-slate-300 px-6 py-10 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">Henüz hesabınıza bağlı teklif bulunmuyor.</div>
                @else
                    <div class="space-y-3">
                        @foreach ($quotes as $quote)
                            <a href="{{ route('account.quotes.show', $quote) }}" class="flex flex-col gap-4 rounded-2xl bg-slate-50 px-5 py-4 transition hover:text-bilya-blue dark:bg-slate-950 lg:flex-row lg:items-center lg:justify-between">
                                <div>
                                    <p class="text-base font-semibold text-slate-900 dark:text-white">{{ $quote->quote_no }}</p>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $quote->submitted_at?->format('d.m.Y H:i') }} • {{ $quote->items_count }} kalem</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $statuses[$quote->status] ?? $quote->status }}</span>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">Detay</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $quotes->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
