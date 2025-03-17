<?php
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ScreeningController;
use Illuminate\Support\Facades\Route;

Route::apiResource('films', FilmController::class);
Route::apiResource('screenings', ScreeningController::class);
