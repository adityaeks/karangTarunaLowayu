<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            // Tambahkan kolom baru untuk score team 1 dan team 2
            $table->integer('score_team1')->default(0)->after('team2');
            $table->integer('score_team2')->default(0)->after('score_team1');
        });

        // Copy data dari kolom score lama ke kolom baru jika diperlukan
        // Jika format score lama adalah "2-1" misalnya, kita bisa parse
        // Untuk sekarang, set default 0 untuk keduanya
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn(['score_team1', 'score_team2']);
        });
    }
};
