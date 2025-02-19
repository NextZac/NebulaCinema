<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Movie;
use Carbon\Carbon;
use App\Http\Resources\MovieSessionResource;

use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function index()
    {
        return Inertia::render("Movies", []);
    }

    public function view(Movie $movie)
    {
        $movie->increment("views");
        return Inertia::render("Movie", [
            "movie" => $movie,
            "release_date" => Carbon::parse(
                $movie->release_date
            )->format("d.m.Y"),
            "categories" => json_decode($movie->categories),
            "image" => $movie->image_path ?? null,
            "sessions" =>
                MovieSessionResource::collection($movie->sessions) ?? null,
        ]);
    }

    public function filter(Request $request)
    {
        $filters = array_filter([
            "release_date" => $request->input("showtime") !== "all"
                ? ($request->input("showtime") == "current" 
                    ? ['<=', Carbon::now()] 
                    : ['>', Carbon::now()])
                : null,
            "categories" => $request->input("categories"),
        ]);
        

        $query = Movie::filter($filters);

        $movie = $query
            ->get()
            ->map(function ($session) {
                // $session->image = $session->movie->image_path;
                $session->image = $session->image_path;
                $session->href = route("Movie", $session->id);
                $session->categories = json_decode($session->categories);
                return $session;
            })
            ->values();

        log::info($movie);

        return response()->json($movie);
    }

    public function search(Request $req)
    {
        if ($req->query("query") != null) {
            $movies = Movie::where(
                "title",
                "like",
                $req->query("query") . "%"
            )
                ->orWhere("titleEng", "like", $req->query("query") . "%")
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
                        $req->query("query") . "%",
                        $req->query("query") . "%",
                        "%" . $req->query("query") . "%",
                        "%" . $req->query("query") . "%",
                    ]
                )
                ->take(3)
                ->get();

            log::info($movies);

            $moviesWithHref = $movies->map(function ($movie) {
                $movie->href = route("Movie", $movie->id);
                return $movie;
            });

            return response()->json($moviesWithHref);
        }
    }

    public function edit(Movie $movie)
    {
        return Inertia::render("Admin/Movies/Edit", [
            "movie" => $movie,
        ]);
    }

    public function store(Request $request)
    {
        $movie = Movie::create([
            "title" => $request->title,
            "titleEng" => $request->titleEng,
            "description" => $request->description,
            "length" => $request->length,
            "cast" => json_encode($request->cast),
            "author" => $request->author,
            "director" => $request->director,
            "age_rating" => $request->age_rating,
            "release_date" => $request->release_date,
            "trailer" => $request->trailer,
        ]);

        return new MovieResource($movie);
    }

    public function update(Request $request, Movie $movie)
    {
        $movie->update([
            "title" => $request->title,
            "titleEng" => $request->titleEng,
            "description" => $request->description,
            "length" => $request->length,
            "cast" => json_encode($request->cast),
            "author" => $request->author,
            "director" => $request->director,
            "age_rating" => $request->age_rating,
            "release_date" => $request->release_date,
            "trailer" => $request->trailer,
        ]);

        return new MovieResource($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(["message" => "Movie deleted successfully."]);
    }
}
