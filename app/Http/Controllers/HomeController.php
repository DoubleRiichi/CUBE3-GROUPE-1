<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $limit = 5; // ou tout autre nombre que vous souhaitez
        $mostPopularMovies = Movie::MostPopular($limit);
        return view('index', compact('mostPopularMovies'));
    }

}
