<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cinemas = [
            [
                "name" => "T1 Nebula",
                "address" => "Tallinn, T1",
                "phone" => "123456789",
                "opens_at" => "08:00",
                "closes_at" => "23:50",
            ],
            [
                "name" => "Tasku Nebula",
                "address" => "Tartu, Tasku",
                "phone" => "123456789",
                "opens_at" => "08:00",
                "closes_at" => "23:50",
            ],
            [
                "name" => "Viru Nebula",
                "address" => "Tallinn, Viru",
                "phone" => "123456789",
                "opens_at" => "08:00",
                "closes_at" => "23:50",
            ],
            [
                "name" => "Ylemiste Nebula",
                "address" => "Tallinn, Ylemiste",
                "phone" => "123456789",
                "opens_at" => "08:00",
                "closes_at" => "23:50",
            ],
        ];

        foreach ($cinemas as $cinema) {
            \App\Models\Cinema::create($cinema);
        }

        $cinemaRooms = [
            [
                "name" => "Saal 1.",
                "cinema_id" => 1,
                "seats" => 96,
                "rows" => 8,
                "columns" => 12,
            ],
            [
                "name" => "Saal 2.",
                "cinema_id" => 1,
                "seats" => 80,
                "rows" => 8,
                "columns" => 10,
            ],
            [
                "name" => "Saal 3.",
                "cinema_id" => 1,
                "seats" => 48,
                "rows" => 6,
                "columns" => 8,
            ],
            [
                "name" => "Saal 1.",
                "cinema_id" => 2,
                "seats" => 96,
                "rows" => 8,
                "columns" => 12,
            ],
            [
                "name" => "Saal 2.",
                "cinema_id" => 2,
                "seats" => 80,
                "rows" => 8,
                "columns" => 10,
            ],
            [
                "name" => "Saal 3.",
                "cinema_id" => 2,
                "seats" => 48,
                "rows" => 6,
                "columns" => 8,
            ],
            [
                "name" => "Saal 1.",
                "cinema_id" => 3,
                "seats" => 96,
                "rows" => 8,
                "columns" => 12,
            ],
            [
                "name" => "Saal 2.",
                "cinema_id" => 3,
                "seats" => 80,
                "rows" => 8,
                "columns" => 10,
            ],
            [
                "name" => "Saal 3.",
                "cinema_id" => 3,
                "seats" => 48,
                "rows" => 6,
                "columns" => 8,
            ],
        ];
        //for each cinema, create these three cinema rooms. Replace each cinema_id with said cinemas id.
        foreach ($cinemaRooms as $cinemaRoom) {
            \App\Models\CinemaRoom::create($cinemaRoom);
        }
    }
}
