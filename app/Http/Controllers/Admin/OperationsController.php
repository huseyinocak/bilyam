<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Contracts\View\View;

class OperationsController extends Controller
{
    public function index(): View
    {
        $quoteRequests = QuoteRequest::query()
            ->withCount('items')
            ->latest()
            ->paginate(20);

        return view('admin.operations.index', compact('quoteRequests'));
    }
}
