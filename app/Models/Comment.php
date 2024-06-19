<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = "comment";
    protected $primaryKey = "id";
    public $timestamps = false;


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

}


