<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $quotes = QuoteRequest::query()->where('customer_user_id', $request->user()->id);

        return view('dashboard', [
            'stats' => [
                ['label' => 'Toplam Teklif', 'value' => (string) (clone $quotes)->count()],
                ['label' => 'Bekleyen', 'value' => (string) (clone $quotes)->whereIn('status', ['new', 'in_review'])->count()],
                ['label' => 'Cevaplanan', 'value' => (string) (clone $quotes)->where('status', 'responded')->count()],
            ],
            'latestQuotes' => QuoteRequest::query()
                ->where('customer_user_id', $request->user()->id)
                ->latest('submitted_at')
                ->take(5)
                ->get(),
        ]);
    }
}
