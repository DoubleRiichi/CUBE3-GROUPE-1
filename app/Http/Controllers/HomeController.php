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
<<<<<<< HEAD
=======
   
>>>>>>> 46b235893d521bdd8905727456db3ec4540624de
        return view('index', compact('mostPopularMovies'));
    }

}
