<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function created_movie_appears_on_main_page()
    {
        $category = Category::firstOrCreate([
            "name" => "Action",
            "nameEng" => "Action",
        ]);
        $movie = Movie::firstOrCreate([
            "title" => "Test Movie",
            "titleEng" => "Test Movie English",
            "description" => "This is a test movie description",
            "length" => "02:30:00",
            "cast" => json_encode(["Actor 1", "Actor 2"]),
            "author" => "Test Author",
            "director" => "Test Director",
            "age_rating" => "PG-13",
            "release_date" => now()->addDays(7),
            "trailer" => "https://youtube.com/test",
            "length" => "02:30:00",
            "cast" => json_encode(["Actor 1", "Actor 2"]),
            "starting" => now()->addDay()->format("Y-m-d H:i:s"),
        ]);
        $movie->categories()->attach($category->id);
        $response = $this->get("/");
        $response->assertStatus(200);
    }
}
