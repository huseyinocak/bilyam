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

    public function getValueAttribute($value)
    {
        if ($value === null) {
            return null;
        }

        return match ($this->type) {
            'string' => json_decode($value, true) ?? trim($value, '"'),
            default => json_decode($value, true) ?? [],
        };
    }

    public function setValueAttribute($value): void
    {
        $type = $this->attributes['type'] ?? $this->type ?? 'json';

        $this->attributes['value'] = match ($type) {
            'string' => json_encode((string) $value, JSON_UNESCAPED_UNICODE),
            default => json_encode($value, JSON_UNESCAPED_UNICODE),
        };
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::query()->where('key', $key)->first()?->value ?? $default;
    }

    public static function putValue(string $key, string $type, mixed $value, ?string $group = null): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['group' => $group, 'type' => $type, 'value' => $value]
        );
    }
}
