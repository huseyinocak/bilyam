<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageHeroController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SpecificationTemplateController;
use App\Http\Controllers\Admin\UseCaseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\EnsureAdminAccess;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', EnsureAdminAccess::class])->group(function () {
        Route::middleware('can:dashboard.view')->group(function () {
            Route::get('/', DashboardController::class)->name('dashboard');
        });

        Route::middleware('can:quotes.view')->group(function () {
            Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
            Route::get('/quotes/{quote}', [QuoteController::class, 'show'])->name('quotes.show');
        });

        Route::middleware('can:quotes.manage')->group(function () {
            Route::patch('/quotes/{quote}/status', [QuoteController::class, 'updateStatus'])->name('quotes.status.update');
            Route::patch('/quotes/{quote}/items/{item}', [QuoteController::class, 'updateItem'])->name('quotes.items.update');
        });

        Route::middleware('can:catalog.categories.manage')->group(function () {
            Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
            Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        });

        Route::middleware('can:catalog.brands.manage')->group(function () {
            Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
            Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
            Route::patch('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
            Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
        });

        Route::middleware('can:catalog.use_cases.manage')->group(function () {
            Route::get('/use-cases', [UseCaseController::class, 'index'])->name('use-cases.index');
            Route::post('/use-cases', [UseCaseController::class, 'store'])->name('use-cases.store');
            Route::patch('/use-cases/{useCase}', [UseCaseController::class, 'update'])->name('use-cases.update');
            Route::delete('/use-cases/{useCase}', [UseCaseController::class, 'destroy'])->name('use-cases.destroy');
        });

        Route::middleware('can:catalog.products.view')->group(function () {
            Route::get('/products', [ProductController::class, 'index'])->name('products.index');
            Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        });

        Route::middleware('can:catalog.products.manage')->group(function () {
            Route::post('/products', [ProductController::class, 'store'])->name('products.store');
            Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::delete('/products/{product}/images/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
            Route::patch('/products/{product}/images/{image}/primary', [ProductController::class, 'makePrimaryImage'])->name('products.images.primary');
        });

        Route::middleware('can:users.manage')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::middleware('can:roles.manage')->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
            Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        Route::middleware('can:catalog.specifications.manage')->group(function () {
            Route::get('/specification-templates', [SpecificationTemplateController::class, 'index'])->name('specification-templates.index');
            Route::post('/specification-templates', [SpecificationTemplateController::class, 'store'])->name('specification-templates.store');
            Route::patch('/specification-templates/{template}', [SpecificationTemplateController::class, 'update'])->name('specification-templates.update');
            Route::delete('/specification-templates/{template}', [SpecificationTemplateController::class, 'destroy'])->name('specification-templates.destroy');
            Route::post('/specification-templates/{template}/fields', [SpecificationTemplateController::class, 'storeField'])->name('specification-templates.fields.store');
            Route::patch('/specification-templates/{template}/fields/{field}', [SpecificationTemplateController::class, 'updateField'])->name('specification-templates.fields.update');
            Route::delete('/specification-templates/{template}/fields/{field}', [SpecificationTemplateController::class, 'destroyField'])->name('specification-templates.fields.destroy');
        });

        Route::middleware('can:activity_logs.view')->group(function () {
            Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        });

        Route::middleware('can:settings.homepage.manage')->group(function () {
            Route::get('/settings/homepage-hero', [HomepageHeroController::class, 'edit'])->name('settings.homepage-hero.edit');
            Route::match(['put', 'patch'], '/settings/homepage-hero', [HomepageHeroController::class, 'update'])->name('settings.homepage-hero.update');
        });

        Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
