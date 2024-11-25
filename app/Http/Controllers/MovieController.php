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

        $query = MovieSession::with([
            'movie' => function ($query) {
                $query->select('id', 'title', 'titleEng');
            }
        ]);

        if ($request->has('cinema') && ($request->input('cinema') !== 'Kõik kinod')) {
            if ($request->input('cinema') === 'Nebula T1') {
                $query->where('cinema', 't1');
            } elseif ($request->input('cinema') === 'Nebula Viru') {
                $query->where('cinema', 'viru');
            } elseif ($request->input('cinema') === 'Nebula Tasku') {
                $query->where('cinema', 'tasku');
            } elseif ($request->input('cinema') === 'Nebula Ülemiste') {
                $query->where('cinema', 'ylemiste');
            }
        }

        if ($request->has('genres') && !empty($request->input('genres'))) {
            $query->whereHas('movie.categories', function ($q) use ($request) {
                $q->whereIn('name', $request->input('genres'));
            });
        }

        $movie_session = $query->get()->map(function ($session) {


            if ($session->cinema === 't1') {
                $session->cinema = 'Nebula T1';
            } elseif ($session->cinema === 'viru') {
                $session->cinema = 'Nebula Viru';
            } elseif ($session->cinema === 'tasku') {
                $session->cinema = 'Nebula Tasku';
            } elseif ($session->cinema === 'ylemiste') {
                $session->cinema = 'Nebula Ülemiste';
            }

            return [
                'id' => $session->id,
                'movie_id' => $session->movie_id,
                'start_time' => Carbon::parse($session->start_time)->format('H:i'),
                'end_time' => $session->end_time,
                'cinema' => $session->cinema,
                'room' => "Room " . $session->room,
                'language' => $session->language,
                'subtitles' => $session->subtitles,
                'format' => $session->format,
                'seats' => $session->seats,
                'main_price' => $session->main_price,
                'vip_price' => $session->vip_price,
                'categories' => $session->movie->categories->map(function ($category) {
                    return ['name' => $category->name];
                }),
                'movie' => $session->movie ? [
                    'title' => $session->movie->title,
                    'titleEng' => $session->movie->titleEng,
                    'age_rating' => $session->movie->age_rating,
                    'length' => $session->movie->length,
                    'trailer' => $session->movie->trailer,
                ] : null
            ];
        })->sortBy(function ($session) {
            // Use Carbon to parse the time and ensure sorting works with proper datetime comparison
            return Carbon::createFromFormat('H:i', $session['start_time']);
        })->values(); // Reset the keys after sorting

        return response()->json($movie_session);
    }
}
