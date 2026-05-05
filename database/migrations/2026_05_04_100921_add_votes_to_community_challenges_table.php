<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('community_challenges', function (Blueprint $table) {
            if (!Schema::hasColumn('community_challenges', 'likes')) {
                $table->integer('likes')->default(0);
            }

            if (!Schema::hasColumn('community_challenges', 'dislikes')) {
                $table->integer('dislikes')->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('community_challenges', function (Blueprint $table) {
            if (Schema::hasColumn('community_challenges', 'likes')) {
                $table->dropColumn('likes');
            }

            if (Schema::hasColumn('community_challenges', 'dislikes')) {
                $table->dropColumn('dislikes');
            }
        });
    }
};