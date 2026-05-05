<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityChallengeVote extends Model
{
    protected $fillable = [
        'user_id',
        'community_challenge_id',
        'vote',
    ];
}