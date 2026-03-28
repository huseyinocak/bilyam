<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard.index', [
            'stats' => [
                'quote_total' => QuoteRequest::query()->count(),
                'quote_received' => QuoteRequest::query()->where('status', 'received')->count(),
                'product_total' => Product::query()->count(),
            ],
        ]);
    }
}
