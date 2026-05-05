<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityChallenge extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'difficulty',
        'xp_reward',
        'likes',
        'dislikes',
        'status',
    ];
}