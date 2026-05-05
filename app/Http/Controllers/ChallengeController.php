<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function random(Request $request)
    {
        $data = $request->validate([
            'difficulty' => 'nullable|string|in:easy,medium,hard',
            'exclude_id' => 'nullable|integer',
        ]);

        $difficulty = $data['difficulty'] ?? 'easy';
        $excludeId = $data['exclude_id'] ?? null;

        $query = Challenge::where('difficulty', $difficulty);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $challenge = $query->inRandomOrder()->first();

        if (!$challenge) {
            return response()->json([
                'message' => 'No challenge found for this difficulty.'
            ], 404);
        }

        return response()->json($challenge);
    }

    public function skip(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        if ($user->energy <= 0) {
            return response()->json([
                'message' => 'Not enough energy to skip.'
            ], 400);
        }

        if (!$user->first_skip_used) {
            $user->first_skip_used = true;
            $message = 'First skip is free!';
        } else {
            $user->energy -= 1;
            $message = 'Challenge skipped!';
        }

        $user->save();

        return response()->json([
            'message' => $message,
            'energy' => $user->energy,
            'user' => $user
        ]);
    }
}