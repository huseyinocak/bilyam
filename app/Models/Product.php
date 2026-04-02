<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'code',
        'sales_mode',
        'visibility_mode',
        'stock_status',
        'price_currency',
        'price',
        'technical_summary',
        'short_description',
        'description',
        'show_price',
        'show_stock',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'show_price' => 'boolean',
        'show_stock' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function useCases(): BelongsToMany
    {
        return $this->belongsToMany(UseCase::class);
    }

    public function specificationValues(): HasMany
    {
        return $this->hasMany(ProductSpecificationValue::class);
    }
}
