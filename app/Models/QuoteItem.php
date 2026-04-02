<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_request_id',
        'product_id',
        'product_name',
        'product_code',
        'quantity',
        'note',
    ];

    public function quoteRequest(): BelongsTo
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function responseItem(): HasOne
    {
        return $this->hasOne(QuoteResponseItem::class);
    }
}
