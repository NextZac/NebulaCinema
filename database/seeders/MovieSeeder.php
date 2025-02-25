<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Movie;
use App\Models\Category;
use App\Models\MovieSession;

class MovieSeeder extends Seeder
{
    public function run()
    {
        //Get movies from Apollo Kino API
        // $startDate = Carbon::now();
        // $endDate = $startDate->copy()->addDays(7);
        // $this->command->info("Getting movies from apollo.");
        // for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
        //     $formattedDate = $date->format("d.m.Y");
        //     $xmlUrl = "https://www.apollokino.ee/xml/Schedule?dt={$formattedDate}";

        //     $response = Http::get($xmlUrl);

        //     if ($response->ok()) {
        //         $this->processApiResponse($response->body());
        //     } else {
        //         echo "Failed to fetch data for {$formattedDate}\n";
        //     }
        // }

        // Get movie sessions from Apollo Kino API
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays(7);
        $this->command->info("Getting movie sessions from apollo.");
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $formattedDate = $date->format("d.m.Y");
            $xmlUrl = "https://www.apollokino.ee/xml/Schedule?dt={$formattedDate}";

            $response = Http::get($xmlUrl);

            if ($response->ok()) {
                $this->processApiResponse($response->body(), true);
            } else {
                echo "Failed to fetch data for {$formattedDate}\n";
            }
        }
    }

    private function processApiResponse(
        string $responseBody,
        bool $isSession = false
    ) {
        // Decode JSON response
        $data = json_decode($responseBody, true);

        if (!$data || !isset($data["Shows"])) {
            throw new \Exception(
                "Invalid JSON format or missing 'Shows' key in response."
            );
        }

        $bar = $this->command
            ->getOutput()
            ->createProgressBar(count($data["Shows"]));
        $bar->start();
        foreach ($data["Shows"] as $show) {
            $bar->advance();
            if (!$isSession) {
                // Fetch detailed event data using the EventID
                $eventDetails = $this->fetchEventDetails($show["EventID"]);

                // Parse release date and length
                $releaseDate = Carbon::parse($show["dtLocalRelease"]);
                $length = gmdate("H:i:s", (int) $show["LengthInMinutes"] * 60);

                // Check if the movie already exists
                $movie = Movie::firstOrCreate(
                    [
                        "title" => $show["Title"],
                        "titleEng" => $show["OriginalTitle"],
                    ],
                    [
                        "trailer" => $eventDetails["trailers"] ?? null,
                        "age_rating" =>
                            $eventDetails["age_rating"] ?? "Unrated",
                        "description" =>
                            $eventDetails["synopsis"] ??
                            $this->generateDescription($show["Title"]),
                        "length" => $length,
                        "cast" => json_encode($eventDetails["cast"] ?? []),
                        "author" => "API",
                        "director" => $eventDetails["director"] ?? null,
                        "release_date" => $releaseDate,
                    ]
                );

                // Attach movie image if provided
                if (isset($eventDetails["image"])) {
                    $imagePath = $this->downloadMedia(
                        $eventDetails["image"],
                        "movie-images"
                    );
                    $movie->addMedia($imagePath)->toMediaCollection("pictures");
                }

                // Sync categories (genres)
                if (!empty($eventDetails["genres"])) {
                    foreach ($eventDetails["genres"] as $categoryName) {
                        $category = Category::firstOrCreate([
                            "name" => trim($categoryName),
                            "nameEng" => trim($categoryName),
                        ]);
                        $movie
                            ->categories()
                            ->syncWithoutDetaching($category->id);
                    }
                }
            } else {
                $movie = Movie::where("title", $show["Title"])->first();
                if ($movie) {
                    $cinemas = ["ylemiste", "t1", "viru", "tasku"];
                    $rooms = [1, 2, 3, 4, 5, 6];

                    $language =
                        $show["SpokenLanguage"]["NameInLanguage"] ?? "en";
                    $subtitles =
                        $show["SubtitleLanguage1"] ??
                        ($show["SubtitleLanguage2"] ?? $language);
                    $format = $show["PresentationMethod"] ?? "2D";
                    $seats =
                        $show["TotalSeats"] ?? ($show["AvailableSeats"] ?? 80);
                    $session = new MovieSession();
                    $session->movie_id = $movie->id;
                    $session->start_time =
                        isset($show["dttmShowStart"]) &&
                        !is_array($show["dttmShowStart"])
                            ? Carbon::parse($show["dttmShowStart"])
                            : now();
                    $session->main_price = 9;
                    $session->vip_price = 12;
                    $session->cinema = (string) $cinemas[array_rand($cinemas)];
                    $session->room = (string) $rooms[array_rand($rooms)];
                    $session->language = (string) $language;
                    $session->subtitles = (string) $subtitles;
                    $session->format = (string) $format;
                    $session->seats = (int) $seats;
                    $session->save();
                }
            }
        }
        $bar->finish();
    }

    private function fetchEventDetails(int $eventID): array
    {
        $url = "https://www.apollokino.ee/xml/Events?eventID={$eventID}";
        $response = Http::get($url);

        if (!$response->successful()) {
            echo "Failed to fetch event details for EventID: {$eventID}\n";
            return [];
        }

        // Decode the JSON response
        $eventData = json_decode($response->body(), true)[0];

        if (!$eventData || !isset($eventData["EventURL"])) {
            throw new \Exception(
                "Invalid JSON format or missing 'Event' key for EventID: {$eventID}"
            );
        }

        $cast = [];
        if (isset($eventData["Cast"])) {
            foreach ($eventData["Cast"] as $actor) {
                $cast[] = $actor["FirstName"] . " " . $actor["LastName"];
            }
        }

        $event = $eventData;
        $trailers =
            "https://www.youtube.com/embed/" . $event["Videos"][0]["Location"];
        return [
            "image" => $event["Images"]["EventMediumImagePortrait"] ?? null,
            "genres" => isset($event["Genres"])
                ? explode(",", $event["Genres"])
                : [],
            "synopsis" => $event["Synopsis"] ?? "",
            "cast" => $cast,
            "director" => isset($event["Directors"][0])
                ? $event["Directors"][0]["FirstName"] .
                    " " .
                    $event["Directors"][0]["LastName"]
                : "Nebula",
            "age_rating" => $event["RatingLabel"] ?? "Unrated",
            "trailers" => $trailers,
        ];
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
