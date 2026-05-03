<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function skipChallenge(Request $request)
    {
        $user = \App\Models\User::first();

        if (!$user) {
            return response()->json([
                'message' => 'No user found'
            ], 404);
        }

        if (!$user->first_skip_used) {
            $user->first_skip_used = true;
            $user->save();

            return response()->json([
                'message' => 'First skip is free',
                'energy' => $user->energy
            ]);
        }

        if ($user->energy <= 0) {
            return response()->json([
                'message' => 'No energy left'
            ], 403);
        }

        $user->energy -= 1;
        $user->save();

        return response()->json([
            'message' => 'Challenge skipped',
            'energy' => $user->energy
        ]);
    }

    public function completeChallenge($id)
    {
        $user = \App\Models\User::first();

        if (!$user) {
            return response()->json([
                'message' => 'No user found'
            ], 404);
        }

        $challenge = \App\Models\Challenge::find($id);

        if (!$challenge) {
            return response()->json([
                'message' => 'Challenge not found'
            ], 404);
        }

        $user->xp += $challenge->xp_reward;
        $user->level = floor($user->xp / 100) + 1;
        $user->save();

        return response()->json([
            'message' => 'Challenge completed',
            'xp' => $user->xp,
            'level' => $user->level
        ]);
    }
    public function leaderboard()
{
    $users = \App\Models\User::orderBy('xp', 'desc')
        ->select('id', 'name', 'xp', 'level')
        ->get();

    return response()->json($users);
}
}