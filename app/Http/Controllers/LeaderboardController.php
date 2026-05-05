<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $users = User::select(
                'id',
                'name',
                'avatar',
                'avatar_color',
                'xp',
                'level',
                'energy'
            )
            ->orderBy('xp', 'desc')
            ->orderBy('level', 'desc')
            ->limit(20)
            ->get();

        return response()->json($users);
    }
}