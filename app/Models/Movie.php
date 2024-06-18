<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = "movies";
    protected $primaryKey = "id";
    public $incrementing = false;
    public $timestamps = false;


    public static function MostPopular($limit) {

        return self::orderBy('popularity', 'desc')->take($limit)->get();
    }

    public static function ById($id) {
        
        return self::find($id); 
    }

    public static function BetweenDates($firstDate, $secondDate, $limit = null) {
        //TODO: add a verification for the date, it should be in the format "YYYY-MM-DD"
        if($limit) 
            return self::whereBetween("release_date", [$firstDate, $secondDate])->limit($limit)->get();
        else
            return self::whereBetween("release_date", [$firstDate, $secondDate])->get();
    }

    public static function beforeDate($date, $limit = null) {
        if($limit) 
            return self::where("release_date", "<", $date)->limit($limit)->get();
        else
            return self::where("release_date", "<", $date)->get();

    }

    public static function afterDate($date, $limit = null) {
        if($limit) 
            return self::where("release_date", ">", $date)->limit($limit)->get();
        else
            return self::where("release_date", ">", $date)->get();

    }

    public static function ByOriginalLanguage($language, $limit = null) {
        if($limit)
            return self::where("original_language", "=", $language)->limit($limit)->get();
        else
            return self::where("original_language", "=", $language)->get();
    }


    public static function byStatus($status, $limit = null) {
        if($limit)
            return self::where("original_language", "=", $status)->limit($limit)->get();
        else
            return self::where("original_language", "=", $status)->get();
    }



}


