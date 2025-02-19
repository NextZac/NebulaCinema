<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Movie;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $topMovies = Cache::remember("top_movies", 5, function () {
            return Movie::select([
                "id",
                "title",
                "titleEng",
                "description",
                "age_rating",
                "image_path",
                "views",
            ])
                ->whereNotNull("release_date")
                ->where("release_date", "<=", Carbon::now())
                ->with("categories:id,name")
                ->orderBy("views", "desc")
                ->get()
                ->map(function ($movie) {
                    return [
                        "id" => $movie->id,
                        "title" => $movie->title,
                        "titleEng" => $movie->titleEng,
                        "description" => $movie->description,
                        "categories" => $movie->categories,
                        "rating" => $movie->age_rating,
                        "image" => $movie->image_path ?? null,
                        "views" => $movie->views,
                    ];
                });
        });

        $upcomingMovies = Cache::remember("upcoming_movies", 300, function () {
            return Movie::select([
                "id",
                "title",
                "titleEng",
                "age_rating",
                "image_path",
                "release_date",
            ])
                ->whereNotNull("release_date")
                ->where("release_date", ">=", Carbon::now())
                ->with("categories:id,name")
                ->get()
                ->map(function ($movie) {
                    return [
                        "id" => $movie->id,
                        "title" => $movie->title,
                        "titleEng" => $movie->titleEng,
                        "categories" => $movie->categories,
                        "rating" => $movie->age_rating,
                        "starting" => Carbon::parse(
                            $movie->release_date
                        )->format("d.m.Y"),
                        "image" => $movie->image_path ?? null,
                    ];
                });
        });

        return Inertia::render("Home", [
            "topMovies" => $topMovies,
            "upcomingMovies" => $upcomingMovies,
        ]);
    }
}
