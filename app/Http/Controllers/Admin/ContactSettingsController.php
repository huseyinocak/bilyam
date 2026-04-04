<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateContactSettingsRequest;
use App\Models\Setting;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.contact', [
            'content' => Setting::getValue('contact.page.content', [
                'title' => 'İletişim',
                'description' => 'Bize telefon, e-posta veya iletişim formu üzerinden ulaşabilirsiniz.',
                'phone' => '+90 555 000 00 00',
                'email' => 'info@bilyam.test',
                'address' => 'Örnek Mah. Örnek Cad. No: 1 İstanbul',
                'working_hours' => 'Pazartesi - Cumartesi / 08:30 - 18:30',
                'map_embed_url' => 'https://www.google.com/maps?q=Istanbul&output=embed',
                'map_link' => 'https://maps.google.com/?q=Istanbul',
                'form_title' => 'Bizimle İletişime Geçin',
                'form_description' => 'Sorularınızı, teklif dışı taleplerinizi ve genel iletişim ihtiyaçlarınızı bize iletebilirsiniz.',
            ]),
            'contactNotificationEmail' => Setting::getValue('contact.notification.email', env('CONTACT_NOTIFICATION_EMAIL', env('ADMIN_NOTIFICATION_EMAIL', 'admin@bilyam.test'))),
            'quoteNotificationEmail' => Setting::getValue('quote.notification.email', env('QUOTE_NOTIFICATION_EMAIL', env('ADMIN_NOTIFICATION_EMAIL', 'admin@bilyam.test'))),
        ]);
    }

    public function update(UpdateContactSettingsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Setting::putValue('contact.page.content', 'json', $data['content'], 'contact');
        Setting::putValue('contact.notification.email', 'string', $data['contact_notification_email'], 'contact');
        Setting::putValue('quote.notification.email', 'string', $data['quote_notification_email'], 'contact');

        ActivityLogger::log('settings.contact.updated', null, [
            'contact_notification_email' => $data['contact_notification_email'],
            'quote_notification_email' => $data['quote_notification_email'],
        ], $request->user()?->id, $request, 'app');

        return back()->with('status', 'İletişim ayarları güncellendi.');
    }
}
