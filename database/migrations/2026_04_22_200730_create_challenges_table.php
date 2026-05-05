<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('challenges')) {
            Schema::create('challenges', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('difficulty')->default('easy');
                $table->integer('xp_reward')->default(10);
                $table->timestamps();
            });
        } else {
            Schema::table('challenges', function (Blueprint $table) {
                if (!Schema::hasColumn('challenges', 'title')) {
                    $table->string('title')->nullable();
                }

                if (!Schema::hasColumn('challenges', 'description')) {
                    $table->text('description')->nullable();
                }

                if (!Schema::hasColumn('challenges', 'difficulty')) {
                    $table->string('difficulty')->default('easy');
                }

                if (!Schema::hasColumn('challenges', 'xp_reward')) {
                    $table->integer('xp_reward')->default(10);
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};