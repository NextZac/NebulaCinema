<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(["auth", "Admin"], function () {
    Route::get("/admin", [AdminController::class, "index"])->name("admin");
});
