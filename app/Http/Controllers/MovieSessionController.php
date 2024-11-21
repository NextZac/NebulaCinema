<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MovieSession;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class MovieSessionController extends Controller
{

    public function index(Request $request)
    {
        $query = MovieSession::with([
            'movie' => function ($query) {
                $query->select('id', 'title', 'titleEng', 'age_rating', 'length');
            }
        ]);

        if ($request->has('date')) {
            // Get the date string from the request (for example, '1. dets')
            $dateString = $request->date; 
        
            // Define a mapping of Estonian months to English months
            $monthMapping = [
                'dets' => 'December',
                'jaanuar' => 'January',
                'veebruar' => 'February',
                'märts' => 'March',
                'aprill' => 'April',
                'mai' => 'May',
                'juuni' => 'June',
                'juuli' => 'July',
                'august' => 'August',
                'september' => 'September',
                'oktoober' => 'October',
                'november' => 'November',
            ];
        
            // Replace Estonian month name with English month name
            foreach ($monthMapping as $estonian => $english) {
                // Replace 'dets' with 'December', etc.
                if (stripos($dateString, $estonian) !== false) {
                    $dateString = str_ireplace($estonian, $english, $dateString);
                    break; // Stop after replacing the first match
                }
            }
        
            // Now parse the formatted date (e.g., '1 December')
            $date = Carbon::parse($dateString);
        
            // Apply the parsed date to your query
            $query->whereDate('start_time', $date);
        }
        

        if ($request->has('cinema') && $request->input('cinema') !== 'Kõik kinod') {
            $query->where('cinema', $request->input('cinema'));
        }

        if ($request->has('language') && !empty($request->input('language'))) {
            $query->where('language', $request->input('language'));
        }

        if ($request->has('subtitles') && !empty($request->input('subtitles'))) {
            $query->where('subtitles', $request->input('subtitles'));
        }

        if ($request->has('format') && !empty($request->input('format'))) {
            $query->where('format', $request->input('format'));
        }

        if ($request->has('genres') && !empty($request->input('genres'))) {
            $query->whereHas('movie.categories', function ($q) use ($request) {
                $q->whereIn('name', $request->input('genres'));
            });
        }

        if ($request->has('age_rating') && !empty($request->input('age_rating'))) {
            $query->whereHas('movie', function ($q) use ($request) {
                $q->whereIn('age_rating', $request->input('age_rating'));
            });
        }

        if ($request->has('timeHours') && $request->has('timeMinutes')) {
            $hours = $request->input('timeHours') ?? '00';
            $minutes = $request->input('timeMinutes') ?? '00';
            $earliestTime = Carbon::parse("{$hours}:{$minutes}");

            $query->where(function ($q) use ($earliestTime) {
                $q->whereTime('start_time', '>=', $earliestTime);
            });
        }



        $movie_session = $query->get()->map(function ($session) {
            return [
                'id' => $session->id,
                'movie_id' => $session->movie_id,
                'start_time' => $session->start_time,
                'end_time' => $session->end_time,
                'cinema' => $session->cinema,
                'room' => $session->room,
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
                ] : null
            ];
        });

        return Inertia::render("Schedule", [
            "movie_session" => $movie_session,
        ]);
    }
}
