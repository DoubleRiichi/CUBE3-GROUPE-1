<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YouTubeController;




Route::get('/', [HomeController::class, 'index']);


Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);

use App\Http\Controllers\RecommendationController;

Route::get('/recommendation-form', [RecommendationController::class, 'showForm'])->name('showForm');
Route::post('/recommend', [RecommendationController::class, 'recommend'])->name('recommend');




