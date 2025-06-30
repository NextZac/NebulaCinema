<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        // In a real application, you would fetch these stats from the database.
        $stats = [
            'users' => \App\Models\User::count(),
            'movies' => \App\Models\Movie::count(),
            'activeSessions' => \App\Models\MovieSession::where('start_time', '>', now())->count(),
        ];

        return Inertia::render("Admin/Home", [
            "user" => Auth::user(),
            "stats" => $stats
        ]);
    }
}
