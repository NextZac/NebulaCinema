<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Movie;
use Carbon\Carbon;

class MovieController extends Controller
{
    public function index()
    {

        return Inertia::render("Movies", [
        ]);
    }

    public function filter(Request $request)
    {
        $filters = array_filter([
            'categories' => $request->input('categories'),
            'age_rating' => $request->input('age_rating'),
        ]);

        $query = Movie::all();

        $movie_session = $query->get()
            ->map(function ($session) {
                $session->categories = $session->movie->categories;
                return $session;
            })
            ->sortBy(function ($session) {
                $session->start_time = Carbon::parse($session->start_time)->format('H:i');
                return Carbon::createFromFormat('H:i', $session['start_time']);
            })->values();

        return response()->json($movie_session);
    }
}
