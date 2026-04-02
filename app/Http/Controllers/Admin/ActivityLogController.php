<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $channel = $request->string('channel')->toString();

        return view('admin.activity-logs.index', [
            'logs' => ActivityLog::query()
                ->with('user')
                ->when($channel, fn ($query) => $query->where('channel', $channel))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'channel' => $channel,
            'channels' => ['app', 'auth', 'quote', 'catalog'],
        ]);
    }
}
