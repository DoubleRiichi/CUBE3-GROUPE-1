<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MovieDetailsController;
use App\Http\Controllers\API\ListingController;

Route::get('/users/index', [UserController::class, "index"]);
Route::get('/users/{id}', [UserController::class, "show"]);

Route::get("/movie/{id}", [MovieDetailsController::class, "show"]);
Route::get("/list/{id}", [ListingController::class, "show"]);

#Route::get('/profile/{name}', [ProfileController::class, "show"])->name('profile.show');

#Route::get("/search", [SearchController::class, "show"]);
