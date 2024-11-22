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

        return Inertia::render("Schedule", [
        ]);
    }

    public function filter(Request $request)
    {

        $query = MovieSession::with([
            'movie' => function ($query) {
                $query->select('id', 'title', 'titleEng', 'trailer', 'age_rating', 'length');
            }
        ]);

        if ($request->has('date')) {
            $dateString = $request->date;

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

            foreach ($monthMapping as $estonian => $english) {
                if (stripos($dateString, $estonian) !== false) {
                    $dateString = str_ireplace($estonian, $english, $dateString);
                    break;
                }
            }

            $date = Carbon::parse($dateString);

            $query->whereDate('start_time', $date);
        }


        if ($request->has('cinema') && ($request->input('cinema') !== 'Kõik kinod')) {
            if($request->input('cinema') === 'Nebula T1') {
                $query->where('cinema', 't1');
            } elseif($request->input('cinema') === 'Nebula Viru') {
                $query->where('cinema', 'viru');
            } elseif($request->input('cinema') === 'Nebula Tasku') {
                $query->where('cinema', 'tasku');
            } elseif($request->input('cinema') === 'Nebula Ülemiste') {
                $query->where('cinema', 'ylemiste');
            }
        }

        /*
        log::info($request->input('cinema'));
        log::info($request->input('language'));
        log::info($request->input('subtitles'));
        log::info($request->input('format'));
        log::info($request->input('genres'));
        log::info($request->input('age_rating'));
        log::info($request->input('timeHours'));
        log::info($request->input('timeMinutes')); 
        */
    

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
                    'trailer'=> $session->movie->trailer,
                ] : null
            ];
        })->sortBy(function ($session) {
            // Use Carbon to parse the time and ensure sorting works with proper datetime comparison
            return Carbon::createFromFormat('H:i', $session['start_time']);
        })->values(); // Reset the keys after sorting

        return response()->json($movie_session);
    }
}
