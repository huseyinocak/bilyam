<?php

namespace App\Listeners;

use App\Events\QuoteReceived;
use App\Jobs\SendQuoteReceivedNotificationJob;

class DispatchQuoteReceivedNotifications
{
    public function handle(QuoteReceived $event): void
    {
        SendQuoteReceivedNotificationJob::dispatch($event->quoteRequest);
    }
}
