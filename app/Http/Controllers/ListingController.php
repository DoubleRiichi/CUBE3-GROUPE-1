<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Listing_Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function show($user_id) {
        //add error handling
        $user = User::ById($user_id);
        if($user_id == null) {
          abort(404);
        } 
        $list = Listing_Movie::JoinListingAndMovie($user->id);

        return view("listing", compact("user", "list"));
      }
  
      public function add(Request $request) {
        
        if(Auth::user()->id == $request->user_id) {
            Listing_Movie::InseretMovie(
              $request->user_id,
              $request->movie_id,
              $request->status,
              $request->rating
            );
            
            return redirect("/list/$request->user_id");

        }

        abort("503");
    }
}
