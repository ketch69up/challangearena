<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserChallenge;

class Challenge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'difficulty',
        'xp_reward',
        'is_verified',
    ];

    public function userChallenges()
    {
        return $this->hasMany(UserChallenge::class);
    }
}