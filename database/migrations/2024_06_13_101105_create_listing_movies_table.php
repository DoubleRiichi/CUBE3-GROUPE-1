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
        Schema::create('listing_movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('status', ['Vus', 'À voir']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');

            $table->unique(['user_id', 'movie_id']); // Assure l'unicité de chaque film dans une liste
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_movies');
    }
};
