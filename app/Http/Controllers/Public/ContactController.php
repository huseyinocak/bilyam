<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\SubmitContactRequest;
use App\Mail\ContactFormSubmittedMail;
use App\Models\Setting;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('public.contact', [
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
        ]);
    }

    public function submit(SubmitContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $recipient = Setting::getValue('contact.notification.email', env('CONTACT_NOTIFICATION_EMAIL', env('ADMIN_NOTIFICATION_EMAIL', 'admin@bilyam.test')));

        Mail::to($recipient)->queue(new ContactFormSubmittedMail($validated));

        ActivityLogger::log('contact.form.submitted', null, [
            'subject' => $validated['subject'],
            'email' => $validated['email'],
        ], $request->user()?->id, $request, 'app');

        return back()->with('status', 'Mesajınız alındı. En kısa sürede sizinle iletişime geçeceğiz.');
    }
}
