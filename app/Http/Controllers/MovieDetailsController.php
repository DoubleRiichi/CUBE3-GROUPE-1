<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;


class MovieDetailsController extends Controller
{
    public function show($movie_id) {
      //add error handling
      $movie = Movie::ById($movie_id);
      $comments = Comment::JoinCommentAndUser($movie->id);
      
      return view("movie-details", compact("movie", "comments"));
    }

}
