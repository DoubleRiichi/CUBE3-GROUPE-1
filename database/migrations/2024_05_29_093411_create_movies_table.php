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
            $table->id("id")->unique()->nullable(false);
            $table->string("original_title");
            $table->string("title");
            $table->string("imdb_id");
            $table->text("overview");
            $table->string('poster_path'); 
            $table->string("original_language");
            $table->integer("runtime");
            $table->string("status");
            $table->float("popularity");
            $table->string("homepage");
            $table->text("tagline");
            $table->unsignedInteger("budget");
            $table->string('release_date');
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

        Schema::create("listing", function (Blueprint $table) {
            $table->id("listing_id");
            $table->text("status");
            $table->integer("note"); 
            $table->unsignedBigInteger('movie_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->foreign("movie_id")->references("id")->on("movies")->onDelete("cascade");
            $table->foreign("user_id")->references("user_id")->on("users_from_app")->onDelete("cascade");
        });

        Schema::create("comments", function (Blueprint $table) {
            $table->id("comment_id");
            $table->text("comment");
            $table->date("date_posted");
            $table->unsignedBigInteger('movie_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->foreign("movie_id")->references("id")->on("movies")->onDelete("cascade");
            $table->foreign("user_id")->references("user_id")->on("users_from_app")->onDelete("cascade");
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
