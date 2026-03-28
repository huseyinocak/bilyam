<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OperationsController;
use App\Http\Controllers\Customer\OfferController;
use App\Http\Controllers\Public\CatalogController;
use App\Http\Controllers\Public\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/branding/{file}', function (string $file) {
    $allowed = ['favicon.png', 'toptanbilyalogo.png'];
    abort_unless(in_array($file, $allowed, true), 404);

    $path = base_path('docs/assets/branding/'.$file);
    abort_unless(is_file($path), 404);

    return response()->file($path, [
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->name('branding.asset');

Route::get('/locale/{locale}', function (string $locale) {
    if (! in_array($locale, ['tr', 'en'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return back();
})->name('locale.switch');

Route::middleware('set-locale')->group(function (): void {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/urunler/{product:slug}', [CatalogController::class, 'show'])->name('catalog.show');

    Route::post('/teklif-listesi/{product:slug}', [QuoteController::class, 'add'])->name('quote.add');
    Route::delete('/teklif-listesi/{product:slug}', [QuoteController::class, 'remove'])->name('quote.remove');
    Route::get('/teklif-listesi', [QuoteController::class, 'list'])->name('quote.list');
    Route::post('/teklif-gonder', [QuoteController::class, 'submit'])->name('quote.submit');

    Route::prefix('musteri')
        ->name('customer.')
        ->middleware(['auth'])
        ->group(function (): void {
            Route::get('/teklifler', [OfferController::class, 'index'])->name('offers.index');
            Route::get('/teklifler/{quoteRequest}', [OfferController::class, 'show'])->name('offers.show');
        });

    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth'])
        ->group(function (): void {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/operations/quotes', [OperationsController::class, 'index'])->name('operations.quotes.index');
        });
});
