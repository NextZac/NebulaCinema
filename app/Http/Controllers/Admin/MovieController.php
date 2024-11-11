<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return Inertia::render("Admin/Movies/Index", ["movies" => $movies]);
    }

    public function create()
    {
        return Inertia::render("Admin/Movies/Create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
        ]);

        Post::create($request->all());

        return redirect()->route("posts.index");
    }

    public function edit(Movie $movie)
    {
        return Inertia::render("Admin/Movies/Edit", ["movie" => $movie]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => "required|string|max:255",
        ]);

        $post->update($request->all());

        return redirect()->route("posts.index");
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route("posts.index");
    }
}
