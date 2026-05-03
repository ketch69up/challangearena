<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function getChallenge($difficulty)
    {
        $challenge = Challenge::where('difficulty', $difficulty)
            ->where('is_verified', true)
            ->inRandomOrder()
            ->first();

        if (!$challenge) {
            return response()->json([
                'message' => 'No challenge found'
            ], 404);
        }

        return response()->json($challenge);
    }
}