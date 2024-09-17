<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $mostPopularMovies = Movie::MostPopular(10);
        $upcomingMovies = Movie::Upcoming()->get();
        $nowPlayingMovies = Movie::NowPlaying()->get();

        return view('index', compact('mostPopularMovies', 'upcomingMovies', 'nowPlayingMovies'));
    }
}
