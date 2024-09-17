<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing_Movie;
use App\Models\Movie;

class ListingController extends Controller
{
    public function addMovieToList(Request $request)
    {
        $request->validate([
            'movie_id' => ['required', 'exists:movies,id'],
            'status' => ['required', 'string'],
        ]);
        $user = Auth::user();
        $movie = Movie::find($request->movie_id);

        $listItem = Listing_Movie::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
            'status' => $request->status,
        ]);

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Film ajouté avec succès",
            "item" => $listItem,
            "item_movie" => $movie
        ], 200);
    }

    public function removeMovieFromList($id)
    {
        $user = Auth::user();
        $listItem = Listing_Movie::find($id);

        if (!$listItem || $listItem->user_id != $user->id) {
            return response()->json([
                "status_code" => 404,
                "status" => "error",
                "message" => "Film non trouvé ou non autorisé"
            ], 404);
        }

        $listItem->delete();

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Film supprimé avec succès"
        ], 200);
    }

    public function toggleMovieStatus($id)
    {
        $user = Auth::user();
        $listItem = Listing_Movie::find($id);

        if (!$listItem || $listItem->user_id != $user->id) {
            return response()->json([
                "status_code" => 404,
                "status" => "error",
                "message" => "Film non trouvé ou non autorisé"
            ], 404);
        }

        if ($listItem->status == "Vus") {
            $listItem->markAsUnseen();
        } else {
            $listItem->markAsSeen();
        }
        $listItem->save();

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Statut du film modifié avec succès",
            "item_status" => $listItem->status
        ], 200);
    }

    public function getUserMovieList()
    {
        $user = Auth::user();
        $listingMovies = $user->listingMovies()->with('movie')->get();
        return response()->json($listingMovies);
    }

    public function updateRating(Request $request, $id)
    {
        $request->validate([
            'rating' => ['nullable', 'integer', 'min:0', 'max:10'],
        ]);

        $user = Auth::user();
        $listItem = Listing_Movie::find($id);

        if (!$listItem || $listItem->user_id != $user->id) {
            return response()->json([
                "status_code" => 404,
                "status" => "error",
                "message" => "Item non trouvé ou non autorisé"
            ], 404);
        }

        $listItem->rating = $request->rating;
        $listItem->save();

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Note du film modifiée avec succès",
            "item_rating" => $listItem->rating
        ], 200);
    }
}
