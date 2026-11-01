<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotionProject extends Model
{
    protected $table = 'motion_projects';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'roles' => 'array',
            'impact_highlights' => 'array',
            'tech_stack' => 'array',
            'team' => 'array',
            'gallery' => 'array',
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
