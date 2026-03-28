<?php

namespace App\Jobs;

use App\Mail\QuoteReceivedGuestMail;
use App\Models\QuoteRequest;
use App\Notifications\QuoteReceivedAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendQuoteReceivedNotificationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function handle(): void
    {
        $adminRecipients = array_filter(array_map('trim', explode(',', (string) config('mail.quote_admin_recipients', ''))));

        if ($adminRecipients !== []) {
            Notification::route('mail', $adminRecipients)
                ->notify(new QuoteReceivedAdminNotification($this->quoteRequest));
        }

        if (! empty($this->quoteRequest->email)) {
            Mail::to($this->quoteRequest->email)->send(new QuoteReceivedGuestMail($this->quoteRequest));
        }
    }
}
