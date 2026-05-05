<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ProofController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\CommunityChallengeController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/leaderboard', [LeaderboardController::class, 'index']);
Route::get('/community-challenges', [CommunityChallengeController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [AuthController::class, 'profile']);

    Route::get('/challenges/random', [ChallengeController::class, 'random']);
    Route::post('/challenges/skip', [ChallengeController::class, 'skip']);

    Route::post('/proofs', [ProofController::class, 'submit']);

    Route::post('/community-challenges', [CommunityChallengeController::class, 'store']);
    Route::post('/community-challenges/{id}/vote', [CommunityChallengeController::class, 'vote']);
});