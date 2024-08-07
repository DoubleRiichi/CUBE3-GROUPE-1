<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Listing_Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        if(Auth::user()->id == $request->user_id) {
            if(!is_numeric($request->rating ))
              return redirect()->back()->withErrors("Une note doit être une valeur numérique.");
  
            if($request->rating > 10 || $request->rating < 0)
              return redirect()->back()->withErrors("La note ne peut être supérieure à 10 ou inférieure à 0.");
  
            
            Listing_Movie::InseretMovie(
                $request->user_id,
                $request->movie_id,
                $request->status,
                $request->rating
            );
              
              return redirect("api/list/$request->user_id");
  
          }
  
          abort("503");
      }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //add error handling
        $user = User::ById($id);
        if($id == null or $user == null) {
          abort(404);
        } 
        $list = Listing_Movie::JoinListingAndMovie($user->id);

        return response()->json(["list" => $list, "user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing_Movie $listing_Movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing_Movie $listing_Movie)
    {
        //
    }
}
