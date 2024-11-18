<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $topMovies = Movie::all()->map(function ($movie) {
            return [
                "id" => $movie->id,
                "title" => $movie->title,
                "titleEng" => $movie->titleEng,
                "categories" => $movie->categories, // Ensure this is formatted properly
                "rating" => $movie->age_rating,
                "image" => $movie->image_path ?? null,
            ];
        });

        $upcomingMovies = Movie::all()->map(function ($movie) {
            return [
                "id" => $movie->id,
                "title" => $movie->title,
                "titleEng" => $movie->titleEng,
                "categories" => $movie->categories, // Ensure this is formatted properly
                "rating" => $movie->age_rating,
                "starting" => $movie->release_date, // Example field
                "image" => $movie->image_path ?? null,
            ];
        });
        return Inertia::render("Home", [
            "topMovies" => $topMovies,
            "upcomingMovies" => $upcomingMovies,
        ]);
    }
}
