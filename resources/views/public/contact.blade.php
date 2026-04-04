@extends('layouts.public')

@section('title', ($content['title'] ?? 'İletişim').' | Bilyam')
@section('meta_description', $content['description'] ?? 'Bilyam iletişim bilgileri, harita ve iletişim formu.')

@section('content')
    <section class="soft-grid border-b border-slate-200/80 py-12 dark:border-slate-800/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="marketing-surface overflow-hidden bg-gradient-to-br from-white via-white to-slate-50 p-8 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950 lg:p-10">
                <p class="eyebrow">Bize Ulaşın</p>
                <h1 class="mt-3 max-w-3xl text-4xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ $content['title'] ?? 'İletişim' }}</h1>
                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $content['description'] ?? '' }}</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)]">
            <div class="space-y-6">
                <div class="marketing-surface p-6">
                    <p class="eyebrow">Bize Ulaşın</p>
                    <div class="mt-5 space-y-4 text-sm">
                        <div class="rounded-[1.5rem] bg-slate-50 p-5 dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Telefon</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $content['phone'] ?: '-' }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-50 p-5 dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">E-posta</p>
                            <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">{{ $content['email'] ?: '-' }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-50 p-5 dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Adres</p>
                            <p class="mt-2 text-sm leading-6 text-slate-900 dark:text-white">{{ $content['address'] ?: '-' }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-50 p-5 dark:bg-slate-950">
                            <p class="text-slate-500 dark:text-slate-400">Çalışma Saatleri</p>
                            <p class="mt-2 text-sm leading-6 text-slate-900 dark:text-white">{{ $content['working_hours'] ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                @if(!empty($content['map_embed_url']))
                    <div class="marketing-surface overflow-hidden p-0">
                        <iframe src="{{ $content['map_embed_url'] }}" class="h-[320px] w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        @if(!empty($content['map_link']))
                            <div class="border-t border-slate-200 p-4 dark:border-slate-800">
                                <a href="{{ $content['map_link'] }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-bilya-blue">Haritada Aç</a>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="marketing-surface p-6 lg:p-8">
                <p class="eyebrow">İletişim Formu</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 dark:text-white">{{ $content['form_title'] ?? 'Bizimle İletişime Geçin' }}</h2>
                <p class="mt-4 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $content['form_description'] ?? '' }}</p>

                <form method="POST" action="{{ route('contact.submit') }}" class="mt-8 space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-900 dark:text-white">Ad Soyad</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">E-posta</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                            @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-900 dark:text-white">Telefon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900 dark:text-white">Konu</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>
                        @error('subject') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-900 dark:text-white">Mesaj</label>
                        <textarea name="message" rows="6" class="mt-2 block w-full rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white" required>{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit" class="cta-primary w-full md:w-auto">Mesajı Gönder</button>
                </form>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8" x-data="{ activeFaq: 0 }">
        <div class="grid gap-6 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)] lg:items-start">
            <div class="marketing-surface overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-bilya-navy p-6 text-white lg:sticky lg:top-24 lg:p-8">
                <p class="eyebrow text-slate-400">Sıkça Sorulan Sorular</p>
                <h2 class="mt-3 text-3xl font-semibold">İletişim ve tedarik sürecinde en çok merak edilen başlıklar</h2>
                <p class="mt-4 text-sm leading-7 text-slate-300">İletişim kurmadan önce temel başlıklara göz atabilirsiniz. İhtiyacınız devam ediyorsa form üzerinden bize doğrudan ulaşabilirsiniz.</p>
                <div class="mt-8 grid gap-3 text-sm text-slate-200">
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 px-4 py-4">Marka ve ürün bulunabilirliği</div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 px-4 py-4">Teslimat ve operasyon süreci</div>
                    <div class="rounded-[1.5rem] border border-white/10 bg-white/5 px-4 py-4">Toplu alım ve teknik destek yaklaşımı</div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="marketing-surface overflow-hidden p-0">
                    <button type="button" @click="activeFaq = activeFaq === 0 ? -1 : 0" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left">
                        <span class="text-base font-semibold text-slate-900 dark:text-white">Hangi marka rulmanlar satıyorsunuz?</span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 dark:bg-slate-900 dark:text-slate-300" x-text="activeFaq === 0 ? '−' : '+'"></span>
                    </button>
                    <div x-show="activeFaq === 0" x-transition class="border-t border-slate-200 px-6 py-5 text-sm leading-7 text-slate-600 dark:border-slate-800 dark:text-slate-300">
                        NSK, FAG, SKF, NTN, KOYO, TIMKEN, NACHI ve farklı markalardaki teknik ürün gruplarını tedarik odaklı olarak sunuyoruz. İhtiyacınıza göre alternatif ürün ve teklif seçenekleri hazırlayabiliyoruz.
                    </div>
                </div>

                <div class="marketing-surface overflow-hidden p-0">
                    <button type="button" @click="activeFaq = activeFaq === 1 ? -1 : 1" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left">
                        <span class="text-base font-semibold text-slate-900 dark:text-white">Teslimat süreniz ne kadar?</span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 dark:bg-slate-900 dark:text-slate-300" x-text="activeFaq === 1 ? '−' : '+'"></span>
                    </button>
                    <div x-show="activeFaq === 1" x-transition class="border-t border-slate-200 px-6 py-5 text-sm leading-7 text-slate-600 dark:border-slate-800 dark:text-slate-300">
                        Talep edilen ürün grubuna ve stok durumuna göre teslimat süresi değişebilir. İstanbul içi hızlı tedarik, Türkiye geneli için planlı sevkiyat ve termin bilgisi teklif aşamasında paylaşılır.
                    </div>
                </div>

                <div class="marketing-surface overflow-hidden p-0">
                    <button type="button" @click="activeFaq = activeFaq === 2 ? -1 : 2" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left">
                        <span class="text-base font-semibold text-slate-900 dark:text-white">Toplu alımlarda özel teklif hazırlıyor musunuz?</span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 dark:bg-slate-900 dark:text-slate-300" x-text="activeFaq === 2 ? '−' : '+'"></span>
                    </button>
                    <div x-show="activeFaq === 2" x-transition class="border-t border-slate-200 px-6 py-5 text-sm leading-7 text-slate-600 dark:border-slate-800 dark:text-slate-300">
                        Evet. Çoklu kalem veya yüksek adetli taleplerinizde size özel fiyat, termin ve operasyon planı hazırlanabilir. Bunun için teklif listesi veya iletişim formu üzerinden bize ulaşmanız yeterlidir.
                    </div>
                </div>

                <div class="marketing-surface overflow-hidden p-0">
                    <button type="button" @click="activeFaq = activeFaq === 3 ? -1 : 3" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left">
                        <span class="text-base font-semibold text-slate-900 dark:text-white">Teknik destek alabiliyor muyum?</span>
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 dark:bg-slate-900 dark:text-slate-300" x-text="activeFaq === 3 ? '−' : '+'"></span>
                    </button>
                    <div x-show="activeFaq === 3" x-transition class="border-t border-slate-200 px-6 py-5 text-sm leading-7 text-slate-600 dark:border-slate-800 dark:text-slate-300">
                        Kategori, ürün kodu, kullanım alanı ve teknik ihtiyaç bilgilerinizi ilettiğinizde size en uygun ürün grupları konusunda yönlendirme sağlayabiliyoruz. Böylece teklif süreci daha hızlı ve doğru ilerliyor.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
