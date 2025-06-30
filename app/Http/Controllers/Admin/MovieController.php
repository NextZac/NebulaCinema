<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Category;
use App\Http\Requests\Admin\StoreMovieRequest;
use App\Http\Requests\Admin\UpdateMovieRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MovieController extends Controller
{

    public static function middleware(): array
    {
        // More granular permissions can be applied per method if needed:
        // $this->middleware('can:create movie')->only(['create', 'store']);
        // $this->middleware('can:edit movie')->only(['edit', 'update']);
        // $this->middleware('can:delete movie')->only(['destroy']);
        return [
            'can:manage_movies'
        ];
    }

    public function index()
    {
        $movies = Movie::with(['categories', 'media'])->latest()->paginate(10);
        // Transform movies to include image URLs if you have an accessor like getImagePathAttribute
        $movies->getCollection()->transform(function ($movie) {
            $movie->image_path = $movie->image_path; // Accessor should handle this
            $movie->trailer_path = $movie->getFirstMediaUrl('trailer');
            return $movie;
        });

        return Inertia::render("Admin/Movies/Index", [
            "movies" => $movies,
        ]);
    }

    public function create()
    {
        return Inertia::render("Admin/Movies/Create", [
            'categories' => Category::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->validated());

        if ($request->has('categories')) {
            $movie->categories()->sync($request->input('categories'));
        }

        if ($request->hasFile('poster_image')) {
            try {
                $movie->addMediaFromRequest('poster_image')->toMediaCollection('pictures');
            } catch (\Exception $e) {
                Log::error('Error uploading poster image: ' . $e->getMessage());
                // Optionally, add a redirect back with an error message
                return redirect()->back()->with('error', 'Could not upload poster image. ' . $e->getMessage());
            }
        }
        
        // Handle trailer video if provided (assuming trailerUrl is a direct URL for now, 
        // but if it's an upload, it needs similar handling to poster_image)
        // If trailer is an upload:
        // if ($request->hasFile('trailer_file')) {
        //     $movie->addMediaFromRequest('trailer_file')->toMediaCollection('trailer');
        // }


        return redirect()->route("admin.movies.index")->with('success', 'Movie created successfully.');
    }

    public function edit(Movie $movie)
    {
        $movie->load(['categories', 'media']); // Eager load categories and media
        return Inertia::render("Admin/Movies/Edit", [
            "movie" => $movie,
            'categories' => Category::orderBy('name')->get(['id', 'name']),
            'currentCategoryIds' => $movie->categories->pluck('id')->toArray(),
            'posterImageUrl' => $movie->getFirstMediaUrl('pictures'), // Get current poster URL
            'trailerUrl' => $movie->getFirstMediaUrl('trailer'), // Get current trailer URL
        ]);
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        if ($request->has('categories')) {
            $movie->categories()->sync($request->input('categories'));
        } else {
            $movie->categories()->sync([]); // Detach all if 'categories' is not present or empty
        }

        if ($request->hasFile('poster_image')) {
            $movie->clearMediaCollection('pictures'); // Clear existing poster(s)
            try {
                $movie->addMediaFromRequest('poster_image')->toMediaCollection('pictures');
            } catch (\Exception $e) {
                 Log::error('Error uploading poster image during update: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Could not upload poster image. ' . $e->getMessage());
            }
        }
        
        // Handle trailer video update similarly if it's an uploaded file

        return redirect()->route("admin.movies.index")->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        // The Spatie MediaLibrary package should handle deleting associated media files
        // automatically when the model is deleted if configured to do so.
        // Or, you can manually clear media before deleting: $movie->clearMediaCollection('pictures'); $movie->clearMediaCollection('trailer');
        $movie->delete();

        return redirect()->route("admin.movies.index")->with('success', 'Movie deleted successfully.');
    }
}
