<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotionConfig extends Model
{
    protected $table = 'motion_configs';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'config_value' => 'array',
        ];
    }

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $record = static::where('config_key', $key)->first();
        if (! $record) {
            return $default;
        }

        return $record->config_value ?? $default;
    }

    public static function setValue(string $key, mixed $value): static
    {
        return static::updateOrCreate(
            ['config_key' => $key],
            ['config_value' => $value]
        );
    }
}
