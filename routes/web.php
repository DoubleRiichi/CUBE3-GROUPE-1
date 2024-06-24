<?php
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieDetailsController;
use App\Http\Controllers\YouTubeController;




Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

use App\Http\Controllers\RecommendationController;


Route::get('/recommendation-form', [RecommendationController::class, 'showForm'])->name('showForm');
Route::post('/recommend', [RecommendationController::class, 'recommend'])->name('recommend');


Route::get('/Subscription',[RegisterController::class,'showRegistrationForm'])->name('register');

Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::get('auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [RegisterController::class, 'handleGoogleCallback']);


Route::get("/movie/{movie_id}", [MovieDetailsController::class, "show"]);