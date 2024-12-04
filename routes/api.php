<?php

use App\Http\Controllers\MovieSessionController;
use App\Http\Controllers\MovieController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get("/schedule/update", [MovieSessionController::class, "filter"])->name(
    "Schedule.update"
);
Route::get("/schedule/genres", [MovieSessionController::class, "genres"])->name(
    "Schedule.genres"
);

Route::group(
    ["prefix" => "api"],
    function () {
    
    Route::get("/movies/update", [MovieController::class, "filter"])->name("Movie.update");
    Route::get("/search", [MovieController::class, "search"])->name("Movie.search");
});