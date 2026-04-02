<?php

namespace App\Support;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ActivityLogger
{
    public static function log(string $event, ?Model $subject = null, array $properties = [], ?int $userId = null, ?Request $request = null, string $channel = 'app'): void
    {
        ActivityLog::create([
            'user_id' => $userId,
            'channel' => $channel,
            'event' => $event,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'properties' => $properties,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }
}
