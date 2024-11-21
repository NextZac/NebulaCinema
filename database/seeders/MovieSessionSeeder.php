<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\MovieSession;
use App\Models\Category;
use App\Models\Movie;
use Carbon\Carbon;

class MovieSessionSeeder extends Seeder
{
    public function run()
    {
        $movies = Movie::all();

        foreach ($movies as $movie) {
            $this->createMovieSessions($movie);
        }
    }

    private function createMovieSessions(Movie $movie)
    {
        $cinemas = ['ylemiste', 't1', 'viru', 'tasku'];
        $rooms = ['1', '2', '3', '4', '5', '6'];
        $formats = ['2D', '3D'];
        $languages = ['Eesti', 'Vene', 'Inglise'];

        $subtitleCombinations = [
            'Eesti, Vene',
            'Eesti, Inglise',
            'Inglise, Vene',
            'Inglise',
            'Eesti',
            'Vene',
            'Puudub'
        ];

        // Create multiple sessions for this movie
        for ($i = 0; $i < 5; $i++) {
            // Randomize session details
            $startTime = Carbon::now()
                ->addDays(rand(0, 14))
                ->setHour(rand(11, 23))
                ->setMinute(rand(0, 11) * 5)
                ->seconds(0);



            MovieSession::create([
                'movie_id' => $movie->id,
                'start_time' => $startTime,
                'main_price' => rand(8, 12),
                'vip_price' => rand(12, 18),
                'cinema' => $cinemas[array_rand($cinemas)],
                'room' => $rooms[array_rand($rooms)],
                'language' => $languages[array_rand($languages)],
                'subtitles' => $subtitleCombinations[array_rand($subtitleCombinations)],
                'format' => $formats[array_rand($formats)],
                'seats' => rand(20, 100),
            ]);
        }
    }

    /**
     * Convert movie length string to minutes
     * 
     * @param string $length Format like "02:30:00"
     * @return int
     */

}