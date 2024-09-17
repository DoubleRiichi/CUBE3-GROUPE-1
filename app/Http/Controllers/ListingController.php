<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Listing_Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
  public function show($user_id)
  {
    //add error handling
    $user = User::ById($user_id);
    if ($user_id == null or $user == null) {
      abort(404);
    }
    $list = Listing_Movie::JoinListingAndMovie($user->id);

    return view("listing", compact("user", "list"));
  }

  public function add(Request $request)
  {
    $user = Auth::user();
    if ($user->id != $request->user_id) {
      return abort(403, 'Unauthorized action.');
    }

    Listing_Movie::create([
      'user_id' => $user->id,
      'movie_id' => $request->movie_id,
      'status' => "À voir",
    ]);

    return redirect("/movie/$request->movie_id");
  }

  public function toggleMovieStatus(Request $request, $id)
  {
    $user = Auth::user();
    if ($user->id != $request->user_id) {
      return abort(403, 'Unauthorized action.');
    }

    $listItem = Listing_Movie::find($id);

    if ($listItem->status == "Vus") {
      $listItem->markAsUnseen();
    } else {
      $listItem->markAsSeen();
    }
    $listItem->save();

    return redirect("/list/$user->id");
  }

  public function updateRating(Request $request, $id)
  {
    $user = Auth::user();
    if ($user->id != $request->user_id) {
      return abort(403, 'Unauthorized action.');
    }

    $listItem = Listing_Movie::find($id);
    $listItem->rating = $request->rating;
    $listItem->save();

    return redirect("/list/$user->id");

  }
}
