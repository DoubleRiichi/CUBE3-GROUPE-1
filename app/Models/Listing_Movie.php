<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_Movie extends Model
{
    use HasFactory;
    protected $table = "listing_movies";

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function ByUserId($userId, $limit = null) {
        return self::where("user_id",  "=", $userId)->limit($limit)->get();
    }

    public static function ByMovieId($movieId, $limit = null) {
        return self::where("movie_id", "=", $movieId)->limit($limit)->get();
    }

    public static function ByUserAndMovieId($movieId, $userId, $limit = null) {

        return self::where([["movie_id", "=", $movieId],
                            ["user_id"], "=", $userId])->limit($limit)->get();
    }

    public static function JoinListingAndMovie($userId) {
        return self::select("listing_movies.*", "movies.status as movie_status", "movies.poster_path", "movies.title")
                            ->where("user_id", "=", $userId)
                            ->join("movies", "movies.id", "=", "listing_movies.movie_id")->get();
    }
}