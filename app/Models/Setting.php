<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'type',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];
}
