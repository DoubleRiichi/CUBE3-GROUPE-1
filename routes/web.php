<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YouTubeController;




Route::get('/', [HomeController::class, 'index']);


Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

//retourne la vue trailer en cliquant sur Recherche
Route::get('/search', function () {
    return redirect('/trailers');
});




#DEBUG
Route::get("/test/{id}/{first_date}/{second_date}/{language}/{status} ", [HomeController::class, "testMovieModel"]);