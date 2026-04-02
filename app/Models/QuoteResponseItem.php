<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteResponseItem extends Model
{
    protected $fillable = [
        'quote_item_id',
        'unit_price',
        'currency',
        'lead_time',
        'note',
        'responded_at',
    ];

    public function quoteItem(): BelongsTo
    {
        return $this->belongsTo(QuoteItem::class);
    }
}
