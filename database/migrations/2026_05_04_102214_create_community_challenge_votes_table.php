<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('community_challenge_votes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('community_challenge_id')
                ->constrained('community_challenges')
                ->cascadeOnDelete();

            $table->string('vote'); // like or dislike

            $table->timestamps();

            $table->unique(['user_id', 'community_challenge_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('community_challenge_votes');
    }
};