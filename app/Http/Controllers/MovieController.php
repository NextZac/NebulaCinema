<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Movie;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function index()
    {
        log::info("Start First");
        return Inertia::render("Movies", []);
    }

    public function filter(Request $request)
    {
        log::info("Filtering Start");
        $filters = array_filter([
            "cinema"=> $request->input("cinema") !== "Kõik kinod" ? $request->input("cinema") : null,
            "categories" => $request->input("categories"),
            "age_rating" => $request->input("age_rating"),
        ]);

        $query = Movie::filter($filters);

        log::info("Got Filters");

        $movie = $query->get()
            ->map(function ($session) {
                return $session;
            })
            ->values();

        log::info($movie);

        return response()->json($movie);
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
}
