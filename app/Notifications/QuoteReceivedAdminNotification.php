<?php

namespace App\Notifications;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteReceivedAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Yeni teklif talebi alındı')
            ->line('Yeni bir teklif talebi sisteme düştü.')
            ->line('Talep No: #'.$this->quoteRequest->id)
            ->line('Firma: '.$this->quoteRequest->company_name)
            ->line('İletişim: '.$this->quoteRequest->full_name.' / '.$this->quoteRequest->phone);
    }
}
