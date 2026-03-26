<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'short_spec',
        'price_text',
        'image_url',
        'source_url',
        'price_visibility',
        'quote_enabled',
        'is_active',
    ];

    protected $casts = [
        'quote_enabled' => 'boolean',
        'is_active' => 'boolean',
    ];


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function isPriceVisible(): bool
    {
        if ($this->price_visibility === 'visible') {
            return true;
        }

        if ($this->price_visibility === 'hidden') {
            return false;
        }

        if ($this->category && $this->category->price_visibility !== 'default') {
            return $this->category->price_visibility === 'visible';
        }

        if ($this->brand && $this->brand->price_visibility !== 'default') {
            return $this->brand->price_visibility === 'visible';
        }

        return false;
    }
}
