<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestReceivedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quote)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Teklif talebiniz alindi: '.$this->quote->quote_no);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.quotes.received');
    }
}
