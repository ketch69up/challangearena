<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Schema;

class LeaderboardController extends Controller
{
    public function index()
    {
        $this->fixMissingUserColumns();

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

    private function fixMissingUserColumns(): void
    {
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
    }
}