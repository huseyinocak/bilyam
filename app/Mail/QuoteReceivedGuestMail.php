<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class QuoteReceivedGuestMail extends Mailable implements ShouldQueue
{
    use Queueable;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Teklif talebiniz alındı');
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.quote-received-guest',
            with: [
                'quoteRequest' => $this->quoteRequest,
            ],
        );
    }
}
