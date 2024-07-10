<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $primaryKey = "id";


    public static function ById($id) {
        
        return self::find($id); 
    }

    public static function BetweenDates($firstDate, $secondDate, $limit = null) {
        //TODO: add a verification for the date, it should be in the format "YYYY-MM-DD"
      return self::whereBetween("created_at", [$firstDate, $secondDate])->limit($limit)->get();
    }

    //If limit is null, it will be ignored so no need for an if-else 
    public static function BeforeDate($date, $limit = null) {
        
      return self::where("created_at", "<", $date)->limit($limit)->get();
    }

    public static function AfterDate($date, $limit = null) {
    
      return self::where("created_at", ">", $date)->limit($limit)->get();
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

    public static function JoinCommentAndUser($movieId) {

      return self::select("comments.*", "users.created_at as user_created_at", "users.updated_at as user_updated_at", "users.name as username", "users.avatar as avatar")
                          ->where("movie_id", "=", $movieId)
                          ->join("users", "users.id", "=", "comments.user_id")->orderByDesc("created_at")->get();
    }

}


