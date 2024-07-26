<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all("*");

        if($movies == null) {
          abort(404);
        }

        return response()->json($movies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $movie = Movie::ById($id);
        if($movie == null) {
          abort(404);
        } 
        $comments = Comment::JoinCommentAndUser($movie->id);
        
        if(Auth::check()) {
          $current_user = Auth::user(); 
        } else {
          $current_user = null;
        }
  
        return response()->json([$movie, $comments, $current_user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
