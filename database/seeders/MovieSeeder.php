<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
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
                "image" => "https://lumiere-a.akamaihd.net/v1/images/p_monstersinc_19751_55afa07a.jpeg?region=0%2C0%2C540%2C810",
                "trailer" => "https://www.youtube.com/embed/CGbgaHoapFM",
                "rating" => "PERE",
                "length" => "01:32:00", // Actual movie length
                "cast" => ["Billy Crystal", "John Goodman", "Mary Gibbs"],
                "director" => "Pete Docter",
                "release_date" => "2001-11-02", // Original release date
            ],
            [
                "categories" => ["Õudus", "Seiklus", "Märul", "Ulme & Fantaasia"],
                "title" => "Viimased meie hulgas",
                "titleEng" => "The Last of Us",
                "image" => "https://m.media-amazon.com/images/M/MV5BY2JiNjU3NWYtMTRlYS00NzY3LWE2NDQtZGFkNWE2MDU4OTExXkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/uLtkt8BonwM",
                "rating" => "16+",
                "length" => "02:20:00",
                "cast" => ["Pedro Pascal", "Bella Ramsey", "Gabriel Luna"],
                "director" => "Craig Mazin",
                "release_date" => "2023-01-15",
            ],
            [
                "categories" => ["Märul", "Seiklus", "Põnevus"],
                "title" => "Spiderman: Pole Koduteed",
                "titleEng" => "Spiderman: No Way Home",
                "image" => "https://resizing.flixster.com/8PNiwC2bpe9OecfYZSOVkvYC5vk=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzL2U5NGM0Y2Q1LTAyYTItNGFjNC1hNWZhLWMzYjJjOTdjMTFhOS5qcGc=",
                "trailer" => "https://www.youtube.com/embed/JfVOs4VSpmA",
                "rating" => "14+",
                "length" => "02:28:00",
                "cast" => ["Tom Holland", "Zendaya", "Benedict Cumberbatch"],
                "director" => "Jon Watts",
                "release_date" => "2021-12-17",
            ],
            [
                "categories" => ["Komöödia", "Seiklus", "Põnevus"],
                "title" => "Nüüd Sa Näed Mind 2",
                "titleEng" => "Now You See Me 2",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:09:00",
                "cast" => ["Jesse Eisenberg", "Mark Ruffalo", "Woody Harrelson"],
                "director" => "Jon M. Chu",
                "release_date" => "2016-06-10",
            ],
            [
                "categories" => ["Märul", "Ulme & Fantaasia", "Põnevus"],
                "title" => "Avengers: Lõppmäng",
                "titleEng" => "Avengers: Endgame",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "03:01:00",
                "cast" => ["Robert Downey Jr.", "Chris Evans", "Scarlett Johansson"],
                "director" => "Anthony ja Joe Russo",
                "release_date" => "2019-04-26",
            ],
            [
                "categories" => ["Seiklus", "Draama", "Põnevus"],
                "title" => "Intseptsioon",
                "titleEng" => "Inception",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:28:00",
                "cast" => ["Leonardo DiCaprio", "Joseph Gordon-Levitt", "Ellen Page"],
                "director" => "Christopher Nolan",
                "release_date" => "2010-07-16",
            ],
            [
                "categories" => ["Draama", "Muusikal", "Biograafia"],
                "title" => "Bohemian Rhapsody",
                "titleEng" => "Bohemian Rhapsody",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:15:00",
                "cast" => ["Rami Malek", "Gwilym Lee", "Ben Hardy"],
                "director" => "Bryan Singer",
                "release_date" => "2018-10-24",
            ],
            [
                "categories" => ["Ulme & Fantaasia", "Seiklus", "Märul"],
                "title" => "Interstellar",
                "titleEng" => "Interstellar",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:49:00",
                "cast" => ["Matthew McConaughey", "Anne Hathaway", "Jessica Chastain"],
                "director" => "Christopher Nolan",
                "release_date" => "2014-11-07",
            ],
            [
                "categories" => ["Komöödia", "Draama", "Romantika"],
                "title" => "Tähed Meie All",
                "titleEng" => "The Fault in Our Stars",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:06:00",
                "cast" => ["Shailene Woodley", "Ansel Elgort"],
                "director" => "Josh Boone",
                "release_date" => "2014-06-06",
            ],
            [
                "categories" => ["Põnevus", "Märul", "Krimi"],
                "title" => "Batman: Pimedaks Rüütliks",
                "titleEng" => "The Dark Knight",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:32:00",
                "cast" => ["Christian Bale", "Heath Ledger", "Aaron Eckhart"],
                "director" => "Christopher Nolan",
                "release_date" => "2008-07-18",
            ],
            [
                "categories" => ["Fantaasia", "Seiklus", "Draama"],
                "title" => "Harry Potter ja Surma Vägised I",
                "titleEng" => "Harry Potter and the Deathly Hallows: Part 1",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:26:00",
                "cast" => ["Daniel Radcliffe", "Rupert Grint", "Emma Watson"],
                "director" => "David Yates",
                "release_date" => "2010-11-19",
            ],
            [
                "categories" => ["Draama", "Biograafia", "Sport"],
                "title" => "Meeskond",
                "titleEng" => "Moneyball",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:13:00",
                "cast" => ["Brad Pitt", "Jonah Hill", "Philip Seymour Hoffman"],
                "director" => "Bennett Miller",
                "release_date" => "2011-09-23",
            ],
            [
                "categories" => ["Märul", "Seiklus", "Ulme & Fantaasia"],
                "title" => "Marss",
                "titleEng" => "The Martian",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "02:24:00",
                "cast" => ["Matt Damon", "Jessica Chastain", "Kristen Wiig"],
                "director" => "Ridley Scott",
                "release_date" => "2015-10-02",
            ],
            [
                "categories" => ["Draama", "Ajalooline", "Sõda"],
                "title" => "1917",
                "titleEng" => "1917",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "01:59:00",
                "cast" => ["George MacKay", "Dean-Charles Chapman"],
                "director" => "Sam Mendes",
                "release_date" => "2019-12-25",
            ],
            [
                "categories" => ["Komöödia", "Draama", "Romantika"],
                "title" => "Armastus Üürikorteris",
                "titleEng" => "(500) Days of Summer",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "12+",
                "length" => "01:35:00",
                "cast" => ["Joseph Gordon-Levitt", "Zooey Deschanel"],
                "director" => "Marc Webb",
                "release_date" => "2009-07-17",
            ],
            [
                "categories" => ["Ulme & Fantaasia", "Põnevus", "Õudus"],
                "title" => "Tulnukas",
                "titleEng" => "Alien",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "16+",
                "length" => "01:57:00",
                "cast" => ["Sigourney Weaver", "Tom Skerritt", "John Hurt"],
                "director" => "Ridley Scott",
                "release_date" => "1979-05-25",
            ]
        ];

        foreach ($movies as $data) {
            $movie = Movie::create([
                "title" => $data["title"],
                "titleEng" => $data["titleEng"],
                "trailer" => $data["trailer"],
                "age_rating" => $data["rating"],
                "description" => $this->generateDescription($data["title"]),
                "length" => $data["length"],
                "cast" => json_encode($data["cast"]),
                "author" => "Stuudio",
                "director" => $data["director"],
                "release_date" => Carbon::parse($data["release_date"]),
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
                "image" => "https://resizing.flixster.com/Nf9rlbQUjzuMQ-vXdRGMScWkcs8=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzLzU4MDZhYjI1LTFiNTQtNDc0Ni04OTI2LWI0Nzc4OWJiNDYxYy5qcGc=",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "14+",
                "starting" => "2024-12-22",
                "length" => "02:15:00",
                "cast" => ["Peter Cullen", "Cristo Fernandes", "Keegan-Michael Key"],
                "director" => "Josh Cooley",
            ],
            [
                "categories" => ["Komöödia", "Seiklus", "Märul"],
                "title" => "Deadpool & Wolverine",
                "titleEng" => "Deadpool & Wolverine",
                "image" =>
                    "https://lumiere-a.akamaihd.net/v1/images/deadpool_wolverine_mobile_640x480_ad8020fd.png",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "14+",
                "starting" => "2024-12-22",
                "length" => "02:15:00",
                "cast" => ["Peter Cullen", "Cristo Fernandes", "Keegan-Michael Key"],
                "director" => "Josh Cooley",
            ],
            [
                "categories" => ["Õudus", "Seiklus", "Märul"],
                "title" => "Tulnukas: Romulus",
                "titleEng" => "Alien: Romulus",
                "image" =>
                    "https://m.media-amazon.com/images/M/MV5BMDU0NjcwOGQtNjNjOS00NzQ3LWIwM2YtYWVmODZjMzQzN2ExXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "16+",
                "starting" => "2024-12-22",
                "length" => "02:15:00",
                "cast" => ["Peter Cullen", "Cristo Fernandes", "Keegan-Michael Key"],
                "director" => "Josh Cooley",
            ],
            [
                "categories" => ["Seiklus", "Märul"],
                "title" => "John Wick 4",
                "titleEng" => "John Wick 4",
                "image" =>
                    "https://m.media-amazon.com/images/I/81fk-N7tvbL._AC_UF894,1000_QL80_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "14+",
                "starting" => "2024-12-22",
                "length" => "02:15:00",
                "cast" => ["Peter Cullen", "Cristo Fernandes", "Keegan-Michael Key"],
                "director" => "Josh Cooley",
            ],
            [
                "categories" => ["Märul", "Ulme & Fantaasia", "Seiklus"],
                "title" => "Doonumi Liivad: Osa Teine",
                "titleEng" => "Dune: Part Two",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "14+",
                "starting" => "2024-12-01",
                "length" => "02:46:00",
                "cast" => ["Timothée Chalamet", "Zendaya", "Rebecca Ferguson"],
                "director" => "Denis Villeneuve",
            ],
            [
                "categories" => ["Komöödia", "Seiklus", "Animatsioon"],
                "title" => "Kaks Põrsakest 2",
                "titleEng" => "Kung Fu Panda 4",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "PERE",
                "starting" => "2024-12-08",
                "length" => "01:34:00",
                "cast" => ["Jack Black", "Awkwafina", "Viola Davis"],
                "director" => "Mike Mitchell",
            ],
            [
                "categories" => ["Märul", "Seiklus", "Põnevus"],
                "title" => "Deadpool 3",
                "titleEng" => "Deadpool & Wolverine",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "16+",
                "starting" => "2024-12-26",
                "length" => "02:00:00",
                "cast" => ["Ryan Reynolds", "Hugh Jackman"],
                "director" => "Shawn Levy",
            ],
            [
                "categories" => ["Märul", "Ulme & Fantaasia", "Seiklus"],
                "title" => "Platvorm 5",
                "titleEng" => "Migration",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "PERE",
                "starting" => "2024-12-12",
                "length" => "01:32:00",
                "cast" => ["Elizabeth Banks", "Kumail Nanjiani"],
                "director" => "Benjamin Renner",
            ],
            [
                "categories" => ["Komöödia", "Seiklus", "Animatsioon"],
                "title" => "Simpsonid: Multifilmi Film 2",
                "titleEng" => "The Simpsons Movie 2",
                "image" => "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
                "trailer" => "https://www.youtube.com/embed/4I8rVcSQbic",
                "rating" => "PERE",
                "starting" => "2024-11-28",
                "length" => "01:50:00",
                "cast" => ["Dan Castellaneta", "Julie Kavner", "Nancy Cartwright"],
                "director" => "David Silverman",
            ]
        ];

        foreach ($upcomingMovies as $upcomingData) {
            $movie = Movie::firstOrCreate(
                [
                    "title" => $upcomingData["title"],
                    "titleEng" => $upcomingData["titleEng"],
                    "trailer" => $data["trailer"],
                    "age_rating" => $upcomingData["rating"],
                    "description" => $this->generateDescription($upcomingData["title"]),
                    "length" => $upcomingData["length"],
                    "cast" => json_encode($upcomingData["cast"]),
                    "author" => "Stuudio",
                    "director" => $upcomingData["director"],
                    "release_date" => isset($upcomingData["starting"]) ? Carbon::parse($upcomingData["starting"]) : now(),
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

    private function generateDescription(string $title): string
    {
        $descriptions = [
            "Põnev seiklus, mis viib vaataja ootamatutesse olukordadesse.",
            "Südamlik lugu, mis puudutab iga vaataja südant.",
            "Tegevusterohke film, mis paneb adrenaliini toimima.",
            "Naljakas ja südamlik lugu, mis toob naeratuse näole.",
            "Müstiline ja põnev film, mis hoiab vaataja pingul.",
        ];

        return $title . ": " . $descriptions[array_rand($descriptions)];
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
