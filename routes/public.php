<?php

use App\Http\Controllers\Public\CategoryController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\QuoteListController;
use App\Http\Controllers\Public\SeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->middleware('throttle:10,1')->name('contact.submit');

Route::get('/quote-list', [QuoteListController::class, 'index'])->name('quote-list.index');
Route::post('/quote-list/items/{product}', [QuoteListController::class, 'store'])->name('quote-list.store');
Route::patch('/quote-list/items/{product}', [QuoteListController::class, 'update'])->name('quote-list.update');
Route::delete('/quote-list/items/{product}', [QuoteListController::class, 'destroy'])->name('quote-list.destroy');
Route::post('/quote-list/submit', [QuoteListController::class, 'submit'])->middleware('throttle:10,1')->name('quote-list.submit');
