<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\GameController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| GAME
|--------------------------------------------------------------------------
*/

Route::get('/challenge/{difficulty}', [ChallengeController::class, 'getChallenge']);
Route::get('/profile/{id}', [GameController::class, 'profile']);
Route::get('/skip/{id}', [GameController::class, 'skipChallenge']);
Route::get('/complete/{challengeId}/{userId}', [GameController::class, 'completeChallenge']);
Route::get('/leaderboard', [GameController::class, 'leaderboard']);