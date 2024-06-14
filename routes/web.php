<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\YouTubeController;

Route::get('/trailers', [YouTubeController::class, 'fetchTrailers']);


