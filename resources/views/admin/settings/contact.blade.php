@extends('layouts.admin')

@section('title', 'İletişim Ayarları | Bilyam')

@section('content')
    <div class="space-y-6">
        <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
            <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">İletişim Ayarları</h1>
            <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Contact sayfasında görünen verileri ve form alıcı e-posta adreslerini ayrı ayrı yönetin.</p>
        </section>

        <form method="POST" action="{{ route('admin.settings.contact.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Sayfa İçeriği</h2>
                <div class="mt-5 grid gap-4 lg:grid-cols-2">
                    <input type="text" name="content[title]" value="{{ old('content.title', $content['title'] ?? '') }}" placeholder="Sayfa başlığı" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="text" name="content[phone]" value="{{ old('content.phone', $content['phone'] ?? '') }}" placeholder="Telefon" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="email" name="content[email]" value="{{ old('content.email', $content['email'] ?? '') }}" placeholder="Görünen iletişim e-postası" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="text" name="content[working_hours]" value="{{ old('content.working_hours', $content['working_hours'] ?? '') }}" placeholder="Çalışma saatleri" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <textarea name="content[description]" rows="4" placeholder="Açıklama" class="lg:col-span-2 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('content.description', $content['description'] ?? '') }}</textarea>
                    <textarea name="content[address]" rows="4" placeholder="Adres" class="lg:col-span-2 rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('content.address', $content['address'] ?? '') }}</textarea>
                    <input type="text" name="content[form_title]" value="{{ old('content.form_title', $content['form_title'] ?? '') }}" placeholder="Form başlığı" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <textarea name="content[form_description]" rows="4" placeholder="Form açıklaması" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">{{ old('content.form_description', $content['form_description'] ?? '') }}</textarea>
                    <input type="url" name="content[map_embed_url]" value="{{ old('content.map_embed_url', $content['map_embed_url'] ?? '') }}" placeholder="Harita embed URL" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="url" name="content[map_link]" value="{{ old('content.map_link', $content['map_link'] ?? '') }}" placeholder="Harita linki" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                </div>
            </section>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-soft dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Form Alıcı E-posta Ayarları</h2>
                <div class="mt-5 grid gap-4 lg:grid-cols-2">
                    <input type="email" name="contact_notification_email" value="{{ old('contact_notification_email', $contactNotificationEmail) }}" placeholder="İletişim formu alıcı e-postası" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                    <input type="email" name="quote_notification_email" value="{{ old('quote_notification_email', $quoteNotificationEmail) }}" placeholder="Teklif formu alıcı e-postası" class="rounded-2xl border-slate-300 text-sm dark:border-slate-700 dark:bg-slate-950 dark:text-white">
                </div>
            </section>

            <div>
                <button type="submit" class="rounded-full bg-bilya-blue px-5 py-3 text-sm font-semibold text-white transition hover:bg-bilya-navy">İletişim Ayarlarını Kaydet</button>
            </div>
        </form>
    </div>
@endsection
