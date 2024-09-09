<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\ListingController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\RegisterController;

Route::post("/login", [LoginController::class, "login"]);
Route::post("/register", [RegisterController::class, "register"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'getUserData']);
    Route::get('/user/comments', [CommentController::class, 'getUserComments']);
    Route::get('/user/movielist', [ListingController::class, 'getUserMovieList']);
    Route::post('/user/avatar', [UserController::class, 'updateUserAvatar']);
    Route::post('/comment', [CommentController::class, 'addComment']);
    Route::delete('/comments/{id}', [CommentController::class, 'removeComment']);
    Route::put('/comments/{id}', [CommentController::class, 'updateComment']);
    Route::post('/list', [ListingController::class, 'addMovieToList']);
    Route::delete('/lists/{movie_id}', [ListingController::class, 'removeMovieFromList']);
    Route::put('/lists/{id}', [ListingController::class, 'toggleMovieStatus']);
    Route::put('/rating/{id}', [ListingController::class, 'updateRating']);
});

Route::get("/movies/search", [MovieController::class, "search"]);
Route::get("/movies/nowPlaying", [MovieController::class, "nowPlaying"]);
Route::get("/movies/upcoming", [MovieController::class, "upcoming"]);
Route::get("/movies/topPopular", [MovieController::class, "topPopular"]);
Route::get('/movie/{id}/comments', [CommentController::class, 'getMovieComments']);
Route::get('/checkEmail', [UserController::class, 'checkEmail']);
