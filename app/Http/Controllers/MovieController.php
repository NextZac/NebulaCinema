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
        return Inertia::render("Movies", []);
    }

    public function search(Request $req)
    {
        $movies = Movie::where(
            "title",
            "like",
            "%" . $req->query("query") . "%"
        )
            ->orWhere("titleEng", "like", "%" . $req->query("query") . "%")
            ->orderByRaw(
                "
                CASE
                    WHEN title LIKE ? THEN 1
                    WHEN titleEng LIKE ? THEN 1
                    WHEN title LIKE ? THEN 2
                    WHEN titleEng LIKE ? THEN 2
                    ELSE 3
                END
            ",
                [
                    $req->query("query"),
                    $req->query("query"),
                    "%" . $req->query("query") . "%",
                    "%" . $req->query("query") . "%",
                ]
            )
            ->take(3)
            ->get();

        $moviesWithHref = $movies->map(function ($movie) {
            $movie->href = route("Movie", $movie->id);
            return $movie;
        });

        return response()->json($moviesWithHref);
    }

    public function filter(Request $request)
    {
        $filters = array_filter([
            "categories" => $request->input("categories"),
            "age_rating" => $request->input("age_rating"),
        ]);

        $query = Movie::all();

        $movie_session = $query
            ->get()
            ->map(function ($session) {
                $session->categories = $session->movie->categories;
                return $session;
            })
            ->sortBy(function ($session) {
                $session->start_time = Carbon::parse(
                    $session->start_time
                )->format("H:i");
                return Carbon::createFromFormat("H:i", $session["start_time"]);
            })
            ->values();

        return response()->json($movie_session);
    }
}
