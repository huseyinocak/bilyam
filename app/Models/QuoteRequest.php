<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuoteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_user_id',
        'full_name',
        'company_name',
        'phone',
        'email',
        'city',
        'note',
        'status',
    ];

    public function customerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }
}
