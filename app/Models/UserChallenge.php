<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Challenge;

class UserChallenge extends Model
{
    protected $fillable = [
        'user_id',
        'challenge_id',
        'status',
        'proof_text',
        'proof_image',
        'is_validated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}