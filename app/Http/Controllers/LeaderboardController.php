<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;

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
            ->where(function ($query) {
                if (Schema::hasColumn('users', 'is_admin')) {
                    $query->where('is_admin', false);
                }
            })
            ->orderBy('xp', 'desc')
            ->orderBy('level', 'desc')
            ->limit(20)
            ->get();

        return response()->json($users);
    }
}