<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\MovieSession;
use App\Models\Category;

class MovieSessionSeeder extends Seeder
{
    public function run()
    {
        $movieSessions = [
            [
                "start_time" => new Date(new Date() . setHours(18, 0, 0, 0)),
                "cinema" => "t1",
                "format" => "2D",
                "subtitles" => "Eesti",
                "language" => "Eesti",
                "room" => "1",
                "seats" => "5",
            ],

        ];

        foreach ($movieSessions as $data) {
            $movieSessions = MovieSession::create([
                "start_time" => $data["start_time"],
                "cinema" => $data["cinema"],
                "format" => $data["format"],
                "subtitles" => $data["subtitles"],
                "language"=> $data["language"],
                "room" => $data["room"],
                "seats" => $data["seats"],
            ]);
        }
    }
}
