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
        Route::get('/movies', [MovieController::class, 'index']);
        Route::get('/movies/{movie}', [MovieController::class, 'edit']);
        Route::post('/movies', [MovieController::class, 'store']);
        Route::put('/movies/{movie}', [MovieController::class, 'update']);
        Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
    }
);
