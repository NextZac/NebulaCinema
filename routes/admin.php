<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TicketController; // Import TicketController
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\Admin;

Route::group(
    ["prefix" => "admin", "middleware" => ["auth", Admin::class]],
    function () {
        Route::get("/", [AdminController::class, "index"])->name("admin.dashboard");

        // Movie Management Routes
        Route::get('/movies', [MovieController::class, 'index'])->name('admin.movies.index');
        Route::get('/movies/create', [MovieController::class, 'create'])->name('admin.movies.create'); // Assuming a create view
        Route::post('/movies', [MovieController::class, 'store'])->name('admin.movies.store');
        Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movies.edit'); // Changed from /movies/{movie}
        Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
        Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('admin.movies.destroy');

        // User Management Routes
        Route::resource('users', UserController::class)->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show', // Optional, if you have a show view
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy',
        ]);
        // If you need to assign roles, you might have specific routes like:
        // Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('admin.users.assignRole');

        // Ticket Management Routes
        Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets.index');
        // Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('admin.tickets.show'); // For later
    }
);
