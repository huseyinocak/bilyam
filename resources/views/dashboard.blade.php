<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Müşteri Paneli</p>
                <h2 class="text-2xl font-semibold leading-tight text-slate-900 dark:text-white">Teklifleriniz ve hesap özetiniz</h2>
            </div>
            <a href="{{ route('home') }}" class="cta-secondary px-4 py-2">Siteye Dön</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[minmax(0,1.4fr)_minmax(320px,0.8fr)]">
                <section class="marketing-surface soft-grid p-6 lg:p-8">
                    <div class="space-y-3">
                        <p class="text-sm font-medium text-bilya-blue">Hoş geldiniz, {{ auth()->user()->name }}.</p>
                        <h3 class="text-3xl font-semibold text-slate-900 dark:text-white">Teklif geçmişinizi, tekrar taleplerinizi ve şirket bilgilerinizi tek yerden yönetin.</h3>
                        <p class="max-w-2xl text-sm leading-6 text-slate-600 dark:text-slate-300">Müşteri paneli teklif takibi, hesap güncelleme ve yeniden talep oluşturma gibi işlemleri sade bir akışta toplar.</p>
                    </div>
                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        @foreach ($stats as $stat)
                            <div class="rounded-[1.5rem] bg-slate-50 p-5 dark:bg-slate-950">
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $stat['label'] }}</p>
                                <p class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">{{ $stat['value'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section class="marketing-surface p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Hızlı Aksiyonlar</h3>
                    <div class="mt-4 grid gap-3 text-sm">
                        <a href="{{ route('account.quotes.index') }}" class="rounded-[1.5rem] border border-slate-200 px-4 py-3 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-800">Tekliflerimi görüntüle</a>
                        <a href="{{ route('account.profile.edit') }}" class="rounded-[1.5rem] border border-slate-200 px-4 py-3 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-800">Profil bilgilerini güncelle</a>
                        <a href="{{ route('quote-list.index') }}" class="rounded-[1.5rem] border border-slate-200 px-4 py-3 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-800">Yeni teklif listesi oluştur</a>
                        <p class="rounded-2xl border border-dashed border-slate-300 px-4 py-3 text-left text-slate-500 dark:border-slate-700">Son tekliflerinize ait tekrar talep aksiyonu detay ekranında aktiftir.</p>
                    </div>
                </section>
            </div>

            @if ($latestQuotes->isNotEmpty())
                <div class="marketing-surface p-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Son Teklifler</h3>
                    <div class="mt-4 space-y-3">
                        @foreach ($latestQuotes as $quote)
                            <a href="{{ route('account.quotes.show', $quote) }}" class="flex items-center justify-between rounded-[1.5rem] bg-slate-50 px-4 py-4 text-sm transition hover:text-bilya-blue dark:bg-slate-950">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ $quote->quote_no }}</p>
                                    <p class="mt-1 text-slate-500 dark:text-slate-400">{{ $quote->submitted_at?->format('d.m.Y H:i') }}</p>
                                </div>
                                <span class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-slate-600 dark:border-slate-700 dark:text-slate-300">{{ $quote->status }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
