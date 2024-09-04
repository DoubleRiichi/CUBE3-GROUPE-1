<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

    private static function _splitKeywords($title) {
        $title = preg_replace("#[[:punct:]]#", "", $title);
        $title = explode(" ", $title);
        $result = [];

        foreach($title as $keyword) {
            array_push($result, ["movies.title", "LIKE", "%$keyword%"]); //LIKE very slow, use full text search in production 
        }

        return $result;
    }


    private static function _validate($request) {
        $validator = Validator::make($request->all(), [
            'title' => 'max:255|min:3|nullable',
            'beforeDate' => 'date|nullable',
            'afterDate' => 'date|nullable',
            'minimumRating' => 'numeric|nullable',
            'minimumPopularity' => 'numeric|nullable',
            'minimumBudget' => 'numeric|nullable',
        ]);

        return $validator;
    }
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
        //
    }

    /**
     * Display the specified resource.
     */
     public function show(Request $request)
    {
        $validation = SearchController::_validate($request);

        if ($validation->fails()) {
            return  response()->json([], 404);
        }
        
        if(Auth::check()) {
            $current_user = Auth::user(); 
        } else {
            $current_user = null;
        }

        $params = []; // to prevent SQL injections
        $keywords = [];
        # Compter le nombre d'option avant de construire la requête pour limiter le nombre de AND?
        if($request->title) { #Full text search?
            $keywords = SearchController::_splitKeywords($request->title);
        }


        if($request->beforeDate) {
            array_push($params, ["movies.release_date", "<", $request->beforeDate]);
        }
        
        if($request->afterDate) {
            array_push($params, ["movies.release_date", ">", $request->afterDate]);
        }

                
        if($request->minimumRating) {                
            array_push($params, ["movies.rating", ">", $request->minimumRating]);
        }

        if($request->minimumPopularity) {
            array_push($params, ["movies.popularity", ">", $request->minimumPopularity]);
        }

        if($request->minimumBudget) {                
            array_push($params, ["movies.budget", ">", $request->minimumBudget]);
        }

        $results = Movie::MultipleWhere($keywords, $params);
        
        return response()->json(["results" => $results, "current_user" => $current_user]);
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
