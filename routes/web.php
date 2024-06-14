<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);


use App\Http\Controllers\YouTubeController;

Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);


