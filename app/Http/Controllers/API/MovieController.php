<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $movies = Movie::all("*");

    if ($movies == null) {
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
    if ($movie == null) {
      abort(404);
    }
    $comments = $movie->comments()->with('user')->get();

    if (Auth::check()) {
      $current_user = Auth::user();
    } else {
      $current_user = null;
    }

    return response()->json(["movie" => $movie, "comments" => $comments, "current_user" => $current_user]);
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

  public function search(Request $request)
  {
    $title = $request->input("title");
    $sortOrder = $request->input("sortOrder");
    $sortBy = $request->input("sortBy");
    $page = $request->input("page", 1);
    $perPage = $request->input("perPage", 10);

    $query = Movie::query();

    if ($title) {
      $query->where("title", "like", "%$title%");
    }

    if ($sortOrder && $sortBy) {
      $validSortColumns = ["title", "popularity", "release_date"];
      if (in_array($sortBy, $validSortColumns)) {
        $query->orderBy($sortBy, $sortOrder);
      }
    }

    $movies = $query->paginate($perPage, ["*"], "page", $page);

    return response()->json($movies);
  }

  public function nowPlaying(Request $request)
  {
    // $page = $request->input("page", 1);
    // $perPage = $request->input("perPage", 10);
    $movies = Movie::NowPlaying()->get();
    //->paginate($perPage, ["*"], "page", $page);

    return response()->json($movies);
  }

  public function upcoming(Request $request)
  {
    // $page = $request->input("page", 1);
    // $perPage = $request->input("perPage", 10);
    $movies = Movie::Upcoming()->get();
    //->paginate($perPage, ["*"], "page", $page);

    return response()->json($movies);
  }

  public function topPopular()
  {
    $movies = Movie::MostPopular(10);

    return response()->json($movies);
  }
}