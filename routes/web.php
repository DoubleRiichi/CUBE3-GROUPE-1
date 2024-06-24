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

Route::get('/register',[RegisterController::class,'showRegistrationForm'])->name('register');;

