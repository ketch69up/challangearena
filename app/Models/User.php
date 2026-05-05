<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'avatar_color',
        'xp',
        'level',
        'energy',
        'first_skip_used',
        'last_energy_update',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}