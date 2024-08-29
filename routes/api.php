<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MovieDetailsController;
use App\Http\Controllers\API\ListingController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\RegisterController;

Route::get('/users', [UserController::class, "index"]);
Route::get('/users/{id}', [UserController::class, "show"]);

Route::get("/movie/{id}", [MovieDetailsController::class, "show"]);
Route::get("/movies", [MovieDetailsController::class, "index"]);
Route::get("/movies/search", [MovieDetailsController::class, "search"]);
Route::get("/movies/nowPlaying", [MovieDetailsController::class, "nowPlaying"]);
Route::get("/movies/upComing", [MovieDetailsController::class, "upComing"]);
Route::get("/movies/topPopular", [MovieDetailsController::class, "topPopular"]);

Route::get("/list/{id}", [ListingController::class, "show"]);
Route::post("/list/{user_id}", [ListingController::class, "store"]);

Route::get('/profile/{name}', [ProfileController::class, "show"]);

Route::post("/search", [SearchController::class, "show"]);

Route::post("/login", [LoginController::class, "login"]);
Route::post("/register", [RegisterController::class, "register"]);