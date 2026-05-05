<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\CommunityChallengeController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/leaderboard', [LeaderboardController::class, 'index']);
Route::get('/community-challenges', [CommunityChallengeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| TEMPORARY DATABASE FIX ROUTE
|--------------------------------------------------------------------------
| Use once, then delete this route.
*/
Route::get('/fix-db-once/{secret}', function ($secret) {
    if ($secret !== 'fix123') {
        return response()->json(['message' => 'Forbidden'], 403);
    }

    if (!Schema::hasColumn('users', 'avatar')) {
        Schema::table('users', function ($table) {
            $table->string('avatar')->default('🧑‍🚀');
        });
    }

    if (!Schema::hasColumn('users', 'avatar_color')) {
        Schema::table('users', function ($table) {
            $table->string('avatar_color')->default('#38bdf8');
        });
    }

    if (!Schema::hasColumn('users', 'xp')) {
        Schema::table('users', function ($table) {
            $table->integer('xp')->default(0);
        });
    }

    if (!Schema::hasColumn('users', 'level')) {
        Schema::table('users', function ($table) {
            $table->integer('level')->default(1);
        });
    }

    if (!Schema::hasColumn('users', 'energy')) {
        Schema::table('users', function ($table) {
            $table->integer('energy')->default(5);
        });
    }

    if (!Schema::hasColumn('users', 'first_skip_used')) {
        Schema::table('users', function ($table) {
            $table->boolean('first_skip_used')->default(false);
        });
    }

    if (!Schema::hasColumn('users', 'last_energy_update')) {
        Schema::table('users', function ($table) {
            $table->timestamp('last_energy_update')->nullable();
        });
    }

    return response()->json([
        'message' => 'Database fixed successfully.'
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [AuthController::class, 'profile']);

    Route::get('/challenges/random', [ChallengeController::class, 'random']);
    Route::post('/challenges/skip', [ChallengeController::class, 'skip']);

    Route::post('/proofs', [ProofController::class, 'submit']);

    Route::post('/community-challenges', [CommunityChallengeController::class, 'store']);
    Route::post('/community-challenges/{id}/vote', [CommunityChallengeController::class, 'vote']);
});