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
      if($movie == null) {
        abort(404);
      } 
      $comments = Comment::JoinCommentAndUser($movie->id);
      
      return view("movie-details", compact("movie", "comments"));
    }


    public function writeComment($movie_id, Request $request) {
      $comment = new Comment;
      $comment->user_id = 1;
      $comment->movie_id = $movie_id;
      $comment->content = filter_var($request->content, FILTER_SANITIZE_SPECIAL_CHARS);
      
      if(empty($request->content)) {
        return redirect()->back()->withErrors("Un commentaire ne peut pas être vide!");
      }
      
      $comment->save();

      return redirect("/movie/$movie_id");
    }

}
