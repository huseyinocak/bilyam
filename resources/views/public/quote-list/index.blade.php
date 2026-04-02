@extends('layouts.public')

@section('title', 'Teklif Listem | Bilyam')
@section('meta_robots', 'noindex,nofollow')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1.2fr)_minmax(360px,0.8fr)]">
            <div class="space-y-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Teklif Listem</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900 dark:text-white">Sectiginiz urunleri tek talepte toplayin</h1>
                    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">Bu liste siparis sepeti degildir. Urun bazinda adet belirtip iletisim bilgilerinizle teklif talebi olusturabilirsiniz.</p>
                </div>

                @error('quote_list')
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-900/40 dark:bg-rose-950/40 dark:text-rose-300">{{ $message }}</div>
                @enderror

                @if ($items === [])
                    <div class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center dark:border-slate-700 dark:bg-slate-900">
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">Teklif listeniz su an bos.</p>
                        <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Kataloga donup urun eklediginizde bu ekranda toplam teklif talebinizi gonderebilirsiniz.</p>
                        <a href="{{ route('products.index') }}" class="mt-6 inline-flex rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Kataloga Don</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <article class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">{{ $item['product']->category?->name }}</p>
                                        <h2 class="mt-2 text-xl font-semibold text-slate-900 dark:text-white">{{ $item['product']->name }}</h2>
                                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">{{ $item['product']->technical_summary }}</p>
                                        <p class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-bilya-blue">{{ $item['product']->code }}</p>
                                    </div>
                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                        <form method="POST" action="{{ route('quote-list.update', $item['product']) }}" class="flex items-center gap-3">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="w-24 rounded-full border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                                            <button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Guncelle</button>
                                        </form>
                                        <form method="POST" action="{{ route('quote-list.destroy', $item['product']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50 dark:border-rose-900/40 dark:text-rose-300">Cikar</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900 lg:sticky lg:top-24">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Teklif Talep Formu</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Misafir olarak devam edebilir veya uye girisi ile teklif gecmisinizi hesabinizda saklayabilirsiniz.</p>
                    <form method="POST" action="{{ route('quote-list.submit') }}" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">Ad Soyad</label>
                            <input type="text" name="name" value="{{ old('name', $prefill['name']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required />
                            @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">E-posta</label>
                            <input type="email" name="email" value="{{ old('email', $prefill['email']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required />
                            @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">Telefon</label>
                            <input type="text" name="phone" value="{{ old('phone', $prefill['phone']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">Firma Adi</label>
                            <input type="text" name="company_name" value="{{ old('company_name', $prefill['company_name']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">Vergi No</label>
                            <input type="text" name="tax_number" value="{{ old('tax_number', $prefill['tax_number']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">Notunuz</label>
                            <textarea name="note" rows="5" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" placeholder="Termin, miktar veya teknik beklentinizi yazabilirsiniz.">{{ old('note') }}</textarea>
                        </div>
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600 dark:bg-slate-950 dark:text-slate-300">Toplam {{ $totalItems }} kalem urun icin teklif talebi olusturulacak.</div>
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">Teklif Talebini Gonder</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
