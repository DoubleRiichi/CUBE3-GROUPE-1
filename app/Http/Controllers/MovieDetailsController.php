<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Comment;
use App\Models\Listing_Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MovieDetailsController extends Controller
{
  public function show($movie_id)
  {
    //add error handling
    $movie = Movie::ById($movie_id);
    if ($movie == null) {
      abort(404);
    }
    $comments = Comment::JoinCommentAndUser($movie->id);

    $current_user = Auth::check() ? Auth::user() : null;
    $isInList = false;

    if ($current_user)
      $isInList = Listing_Movie::where('movie_id', $movie->id)->where('user_id', $current_user->id)->exists();

    return view("movie-details", compact("movie", "comments", "current_user", "isInList"));
  }


  public function writeComment($movie_id, Request $request)
  {

    $user_id = Auth::id(); #get logged in user id
    $content = filter_var($request->content, FILTER_SANITIZE_SPECIAL_CHARS);



    if (strlen($content) > 2000)
      return redirect()->back()->withErrors("Un commentaire ne peut pas dépasser 2000 charactères !");
    if (empty($request->content)) {
      return redirect()->back()->withErrors("Un commentaire ne peut pas être vide!");
    }
    if (!$user_id)
      return redirect()->back()->withErrors("Vous devez être connecté pour laisser un message!");


    Comment::InsertComment($user_id, $movie_id, $content);

    return redirect("/movie/$movie_id");
  }

  public function deleteComment(Request $request)
  {

    if (Auth::check()) {
      $user = User::ById(Auth::id());
      $comment = Comment::ById($request->comment_id);

      if ($user->permissions == "Admin" || $user->id == $comment->user_id)
        Comment::remove($comment->id);
    }

    return redirect()->back();
  }

  public function updateComment(Request $request)
  {
    if (Auth::check()) {
      $user = User::ById(Auth::id());
      $comment = Comment::ById($request->id);

      if ($user->permissions == "admin" || $user->id == $comment->user_id) {
        $content = filter_var($request->content, FILTER_SANITIZE_SPECIAL_CHARS);

        Comment::edit($comment->id, $content);
      }
    }

    return redirect()->back();
  }

}
