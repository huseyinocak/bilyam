<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $quotes = QuoteRequest::query();

        return view('admin.dashboard', [
            'stats' => [
                ['label' => 'Bugun Gelen Teklif', 'value' => (string) (clone $quotes)->whereDate('submitted_at', today())->count()],
                ['label' => 'Bekleyen Is', 'value' => (string) (clone $quotes)->whereIn('status', ['new', 'in_review'])->count()],
                ['label' => 'Katalog Uyarisi', 'value' => (string) Product::query()->whereDoesntHave('images')->count()],
            ],
            'latestQuotes' => QuoteRequest::query()->latest('submitted_at')->take(6)->get(),
        ]);
    }
}
