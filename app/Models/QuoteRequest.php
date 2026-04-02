<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuoteRequest extends Model
{
    protected $fillable = [
        'quote_no',
        'customer_user_id',
        'status',
        'requester_name',
        'requester_email',
        'requester_phone',
        'company_name',
        'tax_number',
        'note',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(QuoteStatusHistory::class);
    }

    public function getIsFullyRespondedAttribute(): bool
    {
        return $this->items->isNotEmpty() && $this->items->every(fn (QuoteItem $item) => $item->responseItem !== null);
    }
}
