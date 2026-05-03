<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'avatar' => 'required|string',
            'avatar_color' => 'required|string',
        ]);

        $nameInput = strtolower($validated['name']);

        if (in_array($nameInput, ['ela', 'elaa'])) {
    $validated['name'] = 'Queen';
    $validated['avatar'] = '/avatars/queen.png'; // image path
    $validated['avatar_color'] = null;
}

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $validated['avatar'],
            'avatar_color' => $validated['avatar_color'],
            'xp' => 0,
            'level' => 1,
            'energy' => 5,
            'first_skip_used' => false,
            'last_energy_update' => now(),
        ]);

        return response()->json([
            'message' => 'User created',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => $user
        ]);
    }
}