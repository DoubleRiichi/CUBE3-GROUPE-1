<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Listing_Movie;
use Illuminate\Http\Request;

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
  
}
