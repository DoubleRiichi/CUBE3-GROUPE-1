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
            $table->id("movie_id");
            $table->text("titre");
            $table->text("synopsis");
            $table->text("genre");
            $table->string('image')->unique()->nullable();
            $table->date('release_date')->nullable();
        });
    
        Schema::create('starring', function (Blueprint $table) {
            $table->id("starring_id");
            $table->unsignedBigInteger('movie_id'); 
            $table->unsignedBigInteger('personalities_id'); 
            $table->foreign("movie_id")->references("movie_id")->on("movies")->onDelete("cascade");
            $table->foreign("personalities_id")->references("personalitie_id")->on("personalities")->onDelete("cascade");
        });
    
        Schema::create('personalities', function (Blueprint $table) {
            $table->id("personalitie_id");
            $table->text("name");
            $table->text("popularity");
        });
    
        Schema::create("comments", function (Blueprint $table) {
            $table->id("comment_id");
            $table->text("comment");
            $table->date("date_posted");
            $table->unsignedBigInteger('movie_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->foreign("movie_id")->references("movie_id")->on("movies")->onDelete("cascade");
            $table->foreign("user_id")->references("user_id")->on("users_from_app")->onDelete("cascade");
        });
    
        Schema::create("listing", function (Blueprint $table) {
            $table->id("listing_id");
            $table->text("status");
            $table->integer("note"); 
            $table->unsignedBigInteger('movie_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->foreign("movie_id")->references("movie_id")->on("movies")->onDelete("cascade");
            $table->foreign("user_id")->references("user_id")->on("users_from_app")->onDelete("cascade");
        });
    
        Schema::create("users_from_app", function (Blueprint $table) {
            $table->id("user_id");
            $table->string("username");
            $table->string("password");
            $table->string("email");
            $table->string("right");
            $table->string('avatar')->nullable();
            $table->string('badge')->nullable();
            $table->date('signup_date');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("movies");
        Schema::dropIfExists('starring');
        Schema::dropIfExists('personalities');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('listing');
        Schema::dropIfExists('users_from_app');
    }
};

