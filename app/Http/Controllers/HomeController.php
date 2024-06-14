<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $limit = 5; // ou tout autre nombre que vous souhaitez
        $mostPopularMovies = Movie::getMostPopularMovies($limit);

        return view('index', compact('mostPopularMovies'));
    }
}
