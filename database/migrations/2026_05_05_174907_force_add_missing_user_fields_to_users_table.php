<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->default('🧑‍🚀');
            }

            if (!Schema::hasColumn('users', 'avatar_color')) {
                $table->string('avatar_color')->default('#38bdf8');
            }

            if (!Schema::hasColumn('users', 'xp')) {
                $table->integer('xp')->default(0);
            }

            if (!Schema::hasColumn('users', 'level')) {
                $table->integer('level')->default(1);
            }

            if (!Schema::hasColumn('users', 'energy')) {
                $table->integer('energy')->default(5);
            }

            if (!Schema::hasColumn('users', 'first_skip_used')) {
                $table->boolean('first_skip_used')->default(false);
            }

            if (!Schema::hasColumn('users', 'last_energy_update')) {
                $table->timestamp('last_energy_update')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Intentionally empty to avoid deleting production user data columns.
    }
};