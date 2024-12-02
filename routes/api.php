<?php

use App\Http\Controllers\MovieSessionController;
use App\Http\Controllers\MovieController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/schedule", [MovieSessionController::class, "index"])->name(
    "Schedule"
);
Route::get("/schedule/update", [MovieSessionController::class, "filter"])->name(
    "Schedule.update"
);
Route::get("/schedule/genres", [MovieSessionController::class, "genres"])->name(
    "Schedule.genres"
);
Route::get("/search", [MovieController::class, "search"])->name("Movie.search");
