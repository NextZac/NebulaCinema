<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Movie;
use App\Models\Category;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movies = [
            [
                "categories" => ["Komöödia", "Seiklus", "Animatsioon"],
                "title" => "Kollide Kompanii",
                "titleEng" => "Monster's INC.",
                "image" =>
                    "https://lumiere-a.akamaihd.net/v1/images/p_monstersinc_19751_55afa07a.jpeg?region=0%2C0%2C540%2C810",
                "rating" => "PERE",
            ],
            [
                "categories" => [
                    "Õudus",
                    "Seiklus",
                    "Märul",
                    "Ulme & Fantaasia",
                ],
                "title" => "Viimased meie hulgas",
                "titleEng" => "The Last of Us",
                "image" =>
                    "https://m.media-amazon.com/images/M/MV5BY2JiNjU3NWYtMTRlYS00NzY3LWE2NDQtZGFkNWE2MDU4OTExXkEyXkFqcGc@._V1_.jpg",
                "rating" => "16+",
            ],
            [
                "categories" => ["Märul", "Seiklus", "Põnevus"],
                "title" => "Spiderman: Pole Koduteed",
                "titleEng" => "Spiderman: No Way Home",
                "image" =>
                    "https://resizing.flixster.com/8PNiwC2bpe9OecfYZSOVkvYC5vk=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzL2U5NGM0Y2Q1LTAyYTItNGFjNC1hNWZhLWMzYjJjOTdjMTFhOS5qcGc=",
                "rating" => "14+",
            ],
            [
                "categories" => ["Komöödia", "Seiklus", "Põnevus"],
                "title" => "Nüüd Sa Näed Mind 2",
                "titleEng" => "Now You See Me 2",
                "image" =>
                    "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "rating" => "12+",
            ],
        ];

        foreach ($movies as $data) {
            $movie = Movie::create([
                "title" => $data["title"],
                "titleEng" => $data["titleEng"],
                "age_rating" => $data["rating"],
                "description" =>
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nunc nec ultricies ultricies, nunc eros ultricies nunc, nec ultricies nunc eros nec eros. Nullam auctor, nunc nec ultricies ultricies, nunc eros ultricies nunc, nec ultricies nunc eros nec eros.",
                "length" => "02:30:00",
                "cast" => json_encode([
                    "Näitleja 1",
                    "Näitleja 2",
                    "Näitleja 3",
                ]),
                "author" => "Stuudio",
                "director" => "Režissöör",
                "release_date" => now(),
            ]);

            // Attach image
            if (isset($data["image"])) {
                $imagePath = $this->downloadMedia(
                    $data["image"],
                    "movie-images"
                );
                $movie->addMedia($imagePath)->toMediaCollection("pictures");
            }

            // Sync categories
            foreach ($data["categories"] as $categoryName) {
                $category = Category::firstOrCreate([
                    "name" => $categoryName,
                    "nameEng" => $categoryName,
                ]);
                $movie->categories()->syncWithoutDetaching($category->id);
            }
        }

        $upcomingMovies = [
            [
                "categories" => ["Komöödia", "Seiklus", "Animatsioon"],
                "title" => "Transformerid: Üks",
                "titleEng" => "Transformers One",
                "image" =>
                    "https://resizing.flixster.com/Nf9rlbQUjzuMQ-vXdRGMScWkcs8=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzLzU4MDZhYjI1LTFiNTQtNDc0Ni04OTI2LWI0Nzc4OWJiNDYxYy5qcGc=",
                "rating" => "14+",
                "starting" => "2024-10-22",
            ],
            [
                "categories" => ["Komöödia", "Seiklus", "Märul"],
                "title" => "Deadpool & Wolverine",
                "titleEng" => "Deadpool & Wolverine",
                "image" =>
                    "https://lumiere-a.akamaihd.net/v1/images/deadpool_wolverine_mobile_640x480_ad8020fd.png",
                "rating" => "14+",
                "starting" => "2024-10-24",
            ],
            [
                "categories" => ["Õudus", "Seiklus", "Märul"],
                "title" => "Tulnukas: Romulus",
                "titleEng" => "Alien: Romulus",
                "image" =>
                    "https://m.media-amazon.com/images/M/MV5BMDU0NjcwOGQtNjNjOS00NzQ3LWIwM2YtYWVmODZjMzQzN2ExXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg",
                "rating" => "16+",
                "starting" => "2024-10-05",
            ],
            [
                "categories" => ["Seiklus", "Märul"],
                "title" => "John Wick 4",
                "titleEng" => "John Wick 4",
                "image" =>
                    "https://m.media-amazon.com/images/I/81fk-N7tvbL._AC_UF894,1000_QL80_.jpg",
                "rating" => "14+",
                "starting" => "2024-10-14",
            ],
        ];

        foreach ($upcomingMovies as $upcomingData) {
            $movie = Movie::firstOrCreate(
                ["title" => $upcomingData["title"]],
                [
                    "titleEng" => $upcomingData["titleEng"],
                    "age_rating" => $upcomingData["rating"],
                    "description" =>
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nunc nec ultricies ultricies, nunc eros ultricies nunc, nec ultricies nunc eros nec eros. Nullam auctor, nunc nec ultricies ultricies, nunc eros ultricies nunc, nec ultricies nunc eros nec eros.",
                    "length" => "02:30:00",
                    "cast" => json_encode([
                        "Näitleja 1",
                        "Näitleja 2",
                        "Näitleja 3",
                    ]),
                    "author" => "Stuudio",
                    "director" => "Režissöör",
                    "release_date" => now(),
                ]
            );

            if (isset($upcomingData["image"])) {
                $imagePath = $this->downloadMedia(
                    $upcomingData["image"],
                    "upcoming-images"
                );
                $movie->addMedia($imagePath)->toMediaCollection("pictures");
            }

            foreach ($upcomingData["categories"] as $categoryName) {
                $category = Category::firstOrCreate([
                    "name" => $categoryName,
                    "nameEng" => $categoryName,
                ]);
                $movie->categories()->syncWithoutDetaching($category->id);
            }
        }
    }

    /**
     * Download a media file from a URL and save it locally.
     *
     * @param string $url The URL of the media file.
     * @param string $directory The directory to save the file in.
     * @return string The local file path.
     */
    private function downloadMedia(string $url, string $directory): string
    {
        $response = Http::get($url);

        if ($response->successful()) {
            $fileName = basename(parse_url($url, PHP_URL_PATH));
            $filePath = Storage::disk("local")->path("$directory/$fileName");

            Storage::disk("local")->makeDirectory($directory);

            file_put_contents($filePath, $response->body());

            return $filePath;
        }

        throw new \Exception("Failed to download media from URL: $url");
    }
}
