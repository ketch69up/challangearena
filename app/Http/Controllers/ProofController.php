<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ProofController extends Controller
{
    public function submit(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $data = $request->validate([
            'challenge_id' => 'required|integer|exists:challenges,id',
            'proof_text' => 'required|string|min:5',
        ]);

        $challenge = Challenge::find($data['challenge_id']);

        if (!$challenge) {
            return response()->json([
                'message' => 'Challenge not found.'
            ], 404);
        }

        $reward = $challenge->xp_reward ?? 10;

        $user->xp += $reward;

        while ($user->xp >= $user->level * 100) {
            $user->level += 1;
            $user->energy = min(5, $user->energy + 1);
        }

        $user->save();

        return response()->json([
            'message' => 'Proof accepted!',
            'reward' => $reward,
            'user' => $user,
        ]);
    }
}