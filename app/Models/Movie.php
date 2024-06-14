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


    function getMostPopularMovies($limit) {

        return Movie::all()->orderBy("popularity")->take($limit)->get();
    }

}
