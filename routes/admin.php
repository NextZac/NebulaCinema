<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\Admin;

Route::group(
    ["prefix" => "admin", "middleware" => ["auth", Admin::class]],
    function () {
        Route::get("/", [AdminController::class, "index"])->name("admin");

        Route::resource("movies", MovieController::class);
    }
);
