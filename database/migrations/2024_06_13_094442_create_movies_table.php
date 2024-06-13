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

        Schema::create("movies", function (Blueprint $table) {
            $table->id();
            $table->string("original_title");
            $table->string("title");
            $table->string("imdb_id");
            $table->text("overview");
            $table->string("poster_path"); 
            $table->string("original_language");
            $table->integer("runtime");
            $table->string("status");
            $table->float("popularity");
            $table->string("homepage");
            $table->text("tagline");
            $table->unsignedInteger("budget");
            $table->string('release_date');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("movies");
    }
};
