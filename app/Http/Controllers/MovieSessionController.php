<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MovieSession;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieSessionController extends Controller
{

    public function index()
    {
        $movie_session = MovieSession::all();
        return Inertia::render("Schedule", ["movie_session" => $movie_session]);
    }
}
