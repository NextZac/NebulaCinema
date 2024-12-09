<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MovieSession;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class MovieSessionController extends Controller
{
    public function index()
    {
        return Inertia::render("Schedule", []);
    }

    public function filter(Request $request)
    {
        $filters = array_filter([
            "date" => $request->input("date"),
            "cinema" =>
                $request->input("cinema") !== "Kõik kinod"
                    ? $request->input("cinema")
                    : null,
            "language" => $request->input("language"),
            "subtitles" => $request->input("subtitles"),
            "format" => $request->input("format"),
            "categories" => $request->input("categories"),
            "age_rating" => $request->input("age_rating"),
            "time" =>
                $request->has("timeHours") && $request->has("timeMinutes")
                    ? [
                        "hours" => $request->input("timeHours"),
                        "minutes" => $request->input("timeMinutes"),
                    ]
                    : null,
        ]);

        log::info("Got Filters");

        $query = MovieSession::with([
            "movie" => function ($query) {
                $query->select(
                    "id",
                    "title",
                    "titleEng",
                    "trailer",
                    "age_rating",
                    "length"
                );
            },
        ])->filter($filters);

        $movie_session = $query
            ->get()
            ->map(function ($session) {
                $session->categories = $session->movie->categories;
                $session->image = $session->movie->image_path;
                return $session;
            })
            ->sortBy(function ($session) {
                $session->start_time = Carbon::parse(
                    $session->start_time
                )->format("H:i");
                return Carbon::createFromFormat("H:i", $session["start_time"]);
            })
            ->values();

        log::info("Movie Sessions" . $movie_session);

        return response()->json($movie_session);
    }

    public function genres()
    {
        // Get all movie sessions with their related movies and categories
        $movieSessions = MovieSession::with(["movie.categories"])
            ->get()
            ->pluck("movie.categories")
            ->flatten()
            ->unique("id")
            ->values()
            ->map(function ($category) {
                return [
                    "name" => $category->name,
                ];
            });

        return response()->json($movieSessions);
    }

    public function buy(MovieSession $session)
    {
        $cinemaRoom = $session->cinemaRoom;
        return Inertia::render("BuyTicket", ["session" => $session, "movie" => $session->movie, "cinema_room" => $cinemaRoom]);
    }
}
