<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware("auth")->group(function () {
    Route::middleware("admin")->group(function () {
        Route::get("/admin", [AdminController::class, "index"])->name("admin");
    });
});
