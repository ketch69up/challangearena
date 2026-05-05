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
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->string('title');
                $table->text('description');
                $table->string('difficulty');
                $table->integer('xp_reward')->default(10);
                $table->integer('likes')->default(0);
                $table->integer('dislikes')->default(0);
                $table->string('status')->default('pending');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('community_challenges');
    }
};