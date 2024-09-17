<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MovieDetailsController;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserListController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

Route::get('/recommendation-form', [RecommendationController::class, 'showForm'])->name('showForm');
Route::post('/recommend', [RecommendationController::class, 'recommend'])->name('recommend');


Route::get('/Subscription', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, "show"])->name("login");
Route::post('/login', [LoginController::class, "login"])->name("login");

Route::get("/logout", [LoginController::class, "logout"])->name("logout");

Route::get('auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);


Route::get("/movie/{movie_id}", [MovieDetailsController::class, "show"]);
Route::post("/movie/{movie_id}", [MovieDetailsController::class, "writeComment"]);


Route::get("/list/{user_id}", [ListingController::class, "show"]);
Route::post("/list", [ListingController::class, "add"]);
Route::post('/list/toggle/{id}', [ListingController::class, 'toggleMovieStatus']);
Route::post('/list/rate/{id}', [ListingController::class, 'updateRating']);

Route::get('/profile/{name}', [ProfileController::class, "show"])->name('profile.show');
Route::get('/profile/{name}/edit', [ProfileController::class, "edit"])->name('profile.edit');
Route::post('/profile/{name}', [ProfileController::class, "update"])->name('profile.update');

Route::get("/search", [SearchController::class, "show"]);
Route::post("/search", [SearchController::class, "search"]);

Route::get("/admin", [AdminController::class, "show"]);
Route::post("/admin/ban", [AdminController::class, "ban"]);
Route::post("/admin/unban", [AdminController::class, "unban"]);

Route::post("/comment/delete", [MovieDetailsController::class, "deleteComment"]);
Route::post("/comment/update", [MovieDetailsController::class, "updateComment"]);

Route::get('send-email', [EmailController::class, 'sendEmail']);

Route::get("/admin/users", [UserListController::class, "show"]);
Route::post("/admin/users", [UserListController::class, "search"]);
