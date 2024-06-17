<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $limit = 5; // ou tout autre nombre que vous souhaitez
        $mostPopularMovies = Movie::MostPopular($limit);

        return view('index', compact('mostPopularMovies'));
    }




    #DEBUG
    public function testMovieModel($id, $first_date, $second_date, $language, $status, $limit = null) {
        
        $id_test = Movie::ById($id);
        $date_test = Movie::BetweenDates($first_date, $second_date);
        $before_date = Movie::beforeDate($first_date);
        $after_date = Movie::beforeDate($second_date);
        $by_language = Movie::ByOriginalLanguage($language);
        $by_status = Movie::byStatus($status);


        return view("MovieTest", compact("id_test", "date_test", "before_date", "after_date", "by_language", "by_status"));
    }
}
