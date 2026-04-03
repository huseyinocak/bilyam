@extends('layouts.public')

@section('title', 'Teklif Listem | Bilyam')
@section('meta_robots', 'noindex,nofollow')

@section('content')
    <section class="soft-grid border-b border-slate-200/80 py-12 dark:border-slate-800/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="marketing-surface overflow-hidden bg-gradient-to-br from-white via-white to-slate-50 p-8 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 lg:p-10">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="eyebrow">Teklif Listem</p>
                        <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-slate-900 dark:text-white">Seçtiğiniz ürünleri kurumsal talep listesinde toplayın.</h1>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">Bu alan sipariş sepeti değil, çoklu kalem teklif sürecinin başlangıç noktasıdır. Ürünleri net biçimde gruplayın ve tek form ile talebinizi gönderin.</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Toplam kalem</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">{{ $totalItems }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-100 px-5 py-4 text-sm dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Talep türü</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">B2B</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1.2fr)_minmax(360px,0.8fr)]">
            <div class="space-y-6">
                <div class="marketing-surface p-6">
                    <p class="eyebrow">Talep Kalemleri</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900 dark:text-white">Teklif listenizi kontrol edin</h2>
                    <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-slate-300">Kalemleri güncelleyin, miktarları netleştirin ve yalnızca ihtiyaç duyduğunuz ürünlerle ilerleyin.</p>
                </div>

                @error('quote_list')
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 dark:border-rose-900/40 dark:bg-rose-950/40 dark:text-rose-300">{{ $message }}</div>
                @enderror

                @if ($items === [])
                    <div class="marketing-surface border-dashed p-10 text-center dark:text-slate-300">
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">Teklif listeniz şu an boş.</p>
                        <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">Kataloğa dönüp ürün eklediğinizde bu ekranda toplam teklif talebinizi gönderebilirsiniz.</p>
                        <a href="{{ route('products.index') }}" class="mt-6 cta-primary">Kataloğa Dön</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <article class="marketing-surface p-5">
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
                                            <button type="submit" class="cta-secondary px-4 py-2">Güncelle</button>
                                        </form>
                                        <form method="POST" action="{{ route('quote-list.destroy', $item['product']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600 transition hover:bg-rose-50 dark:border-rose-900/40 dark:text-rose-300">Çıkar</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <div class="marketing-surface lg:sticky lg:top-24 p-6">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Teklif Talep Formu</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600 dark:text-slate-300">Misafir olarak devam edebilir veya üye girişi ile teklif geçmişinizi hesabınızda saklayabilirsiniz.</p>
                    <form method="POST" action="{{ route('quote-list.submit') }}" class="mt-6 space-y-4">
                        @csrf
                        <div class="rounded-[1.5rem] border border-slate-200 p-4 dark:border-slate-800">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">İletişim Bilgileri</p>
                            <div class="mt-4 space-y-4">
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
                            </div>
                        </div>

                        <div class="rounded-[1.5rem] border border-slate-200 p-4 dark:border-slate-800">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Firma Bilgileri</p>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label class="text-sm font-semibold text-slate-900 dark:text-white">Firma Adı</label>
                                    <input type="text" name="company_name" value="{{ old('company_name', $prefill['company_name']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-slate-900 dark:text-white">Vergi No</label>
                                    <input type="text" name="tax_number" value="{{ old('tax_number', $prefill['tax_number']) }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" />
                                </div>
                            </div>
                        </div>

                        <div class="rounded-[1.5rem] border border-slate-200 p-4 dark:border-slate-800">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Ek Notlar</p>
                            <div class="mt-4">
                                <label class="text-sm font-semibold text-slate-900 dark:text-white">Notunuz</label>
                                <textarea name="note" rows="5" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" placeholder="Termin, miktar veya teknik beklentinizi yazabilirsiniz.">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <div>
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600 dark:bg-slate-950 dark:text-slate-300">Toplam {{ $totalItems }} kalem ürün için teklif talebi oluşturulacak.</div>
                        </div>
                        <button type="submit" class="cta-primary w-full">Teklif Talebini Gönder</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
