<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('user_challenges')) {
            Schema::create('user_challenges', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('challenge_id')->nullable();
                $table->string('status')->default('completed');
                $table->text('proof_text')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('user_challenges', function (Blueprint $table) {
                if (!Schema::hasColumn('user_challenges', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }

                if (!Schema::hasColumn('user_challenges', 'challenge_id')) {
                    $table->unsignedBigInteger('challenge_id')->nullable();
                }

                if (!Schema::hasColumn('user_challenges', 'status')) {
                    $table->string('status')->default('completed');
                }

                if (!Schema::hasColumn('user_challenges', 'proof_text')) {
                    $table->text('proof_text')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_challenges');
    }
};