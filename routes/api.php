<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreeningController;
use Illuminate\Support\Facades\Route;

Route::apiResource('movies', MovieController::class);
Route::apiResource('screenings', ScreeningController::class);
