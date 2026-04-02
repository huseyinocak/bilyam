<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        CarbonImmutable::setLocale(config('app.locale'));

        View::composer(['layouts.public', 'public.*'], function ($view) {
            $items = session('quote_list', []);

            $view->with('quoteListCount', count($items));
        });
    }
}
