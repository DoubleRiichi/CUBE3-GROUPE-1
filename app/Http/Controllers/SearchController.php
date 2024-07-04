<?php

namespace App\Http\Controllers;


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
    public function show() {
        return view('search');
    }


    public function search(Request $request) {
        
        $validation = SearchController::_validate($request);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
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
        
        
        return view("search", compact("results", "current_user"));
    }




}
