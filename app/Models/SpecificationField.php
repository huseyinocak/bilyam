<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecificationField extends Model
{
    protected $fillable = [
        'specification_template_id',
        'name',
        'key',
        'field_type',
        'unit',
        'is_filterable',
        'is_required',
        'sort_order',
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_required' => 'boolean',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(SpecificationTemplate::class, 'specification_template_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(ProductSpecificationValue::class);
    }
}
