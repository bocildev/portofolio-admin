<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'roles' => 'array',
            'permissions' => 'array',
        ];
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, (array) ($this->roles ?? []), true);
    }

    public function canPermission(string $permission): bool
    {
        return in_array('*', (array) ($this->permissions ?? []), true)
            || in_array($permission, (array) ($this->permissions ?? []), true);
    }
}
