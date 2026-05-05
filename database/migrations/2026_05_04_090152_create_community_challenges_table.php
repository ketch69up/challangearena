<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('community_challenges')) {
            Schema::create('community_challenges', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('title');
                $table->text('description');
                $table->string('difficulty')->default('easy');
                $table->integer('xp_reward')->default(10);
                $table->integer('likes')->default(0);
                $table->integer('dislikes')->default(0);
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        } else {
            Schema::table('community_challenges', function (Blueprint $table) {
                if (!Schema::hasColumn('community_challenges', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }

                if (!Schema::hasColumn('community_challenges', 'title')) {
                    $table->string('title')->default('Untitled');
                }

                if (!Schema::hasColumn('community_challenges', 'description')) {
                    $table->text('description')->nullable();
                }

                if (!Schema::hasColumn('community_challenges', 'difficulty')) {
                    $table->string('difficulty')->default('easy');
                }

                if (!Schema::hasColumn('community_challenges', 'xp_reward')) {
                    $table->integer('xp_reward')->default(10);
                }

                if (!Schema::hasColumn('community_challenges', 'likes')) {
                    $table->integer('likes')->default(0);
                }

                if (!Schema::hasColumn('community_challenges', 'dislikes')) {
                    $table->integer('dislikes')->default(0);
                }

                if (!Schema::hasColumn('community_challenges', 'status')) {
                    $table->string('status')->default('pending');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('community_challenges');
    }
};