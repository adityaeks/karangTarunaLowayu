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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Judul Berita
            $table->string('slug')->unique();
            $table->text('content');
            $table->foreignId('author_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->date('published_at')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        Schema::table('beritas', function (Blueprint $table) {
            if (Schema::hasTable('authors')) {
                $table->foreign('author_id')
                      ->references('id')
                      ->on('authors')
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
            }

            if (Schema::hasTable('categories')) {
                $table->foreign('category_id')
                      ->references('id')
                      ->on('categories')
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
