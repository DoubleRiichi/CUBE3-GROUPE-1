<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_Movie extends Model
{
    use HasFactory;
    protected $table = "listing_movies";
    protected $fillable = ['status', 'movie_id', 'user_id', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function markAsSeen()
    {
        $this->status = 'Vus';
        $this->save();
    }

    public function markAsUnseen()
    {
        $this->status = 'À voir';
        $this->save();
    }

    public static function ByUserId($userId, $limit = null)
    {
        return self::where("user_id", "=", $userId)->limit($limit)->get();
    }

    public static function ByMovieId($movieId, $limit = null)
    {
        return self::where("movie_id", "=", $movieId)->limit($limit)->get();
    }

    public static function ByUserAndMovieId($movieId, $userId, $limit = null)
    {

        return self::where([
            ["movie_id", "=", $movieId],
            ["user_id"],
            "=",
            $userId
        ])->limit($limit)->get();
    }

    public static function JoinListingAndMovie($userId)
    {
        return self::select("listing_movies.*", "movies.status as movie_status", "movies.poster_path", "movies.title")
            ->where("user_id", "=", $userId)
            ->join("movies", "movies.id", "=", "listing_movies.movie_id")->get();
    }

    public static function InseretMovie($user_id, $movie_id, $status, $rating)
    {
        $list = new Listing_Movie();
        $list->user_id = $user_id;
        $list->movie_id = $movie_id;
        $list->status = $status;
        $list->rating = $rating;

        $list->save();
    }
}
