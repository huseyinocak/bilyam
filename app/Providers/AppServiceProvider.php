<?php

namespace App\Providers;

use App\Events\QuoteReceived;
use App\Listeners\DispatchQuoteReceivedNotifications;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(QuoteReceived::class, DispatchQuoteReceivedNotifications::class);
    }
}
