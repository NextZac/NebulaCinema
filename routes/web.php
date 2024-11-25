<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieSessionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", [HomeController::class, "index"])->name("Home");

Route::get("/lang/{lang}", function ($language) {
    Session::put("locale", $language);
    return redirect()->back();
});

Route::get("/lang/en", function () {
    Session::put("locale", "en");
    return redirect()->back();
})->name("toEnglish");

Route::get("/lang/et", function () {
    Session::put("locale", "et");
    return redirect()->back();
})->name("toEstonian");

Route::get("/components", function () {
    return Inertia::render("Components");
})->name("Components");

Route::get('/schedule', [MovieSessionController::class, 'index'])->name('Schedule');
Route::get('/schedule/update', [MovieSessionController::class, 'filter'])->name('Schedule.update');
Route::get('/schedule/genres', [MovieSessionController::class, 'genres'])->name('Schedule.genres');

Route::get("/movies", function () {
    return Inertia::render("Movies");
})->name("Movies");

Route::get("/giftcards", function () {
    return Inertia::render("Giftcards");
})->name("Giftcards");

Route::get("/terms", function () {
    return Inertia::render("Terms");
})->name("Terms");

Route::get("/privacy", function () {
    return Inertia::render("Privacy");
})->name("Privacy");

// Route::get("/dashboard", function () {
//     return Inertia::render("Dashboard");
// })
//     ->middleware(["auth", "verified"])
//     ->name("dashboard");

// Route::middleware("auth")->group(function () {
//     Route::get("/profile", [ProfileController::class, "edit"])->name(
//         "profile.edit"
//     );
//     Route::patch("/profile", [ProfileController::class, "update"])->name(
//         "profile.update"
//     );
//     Route::delete("/profile", [ProfileController::class, "destroy"])->name(
//         "profile.destroy"
//     );
// });

require __DIR__ . "/admin.php";
require __DIR__ . "/auth.php";
