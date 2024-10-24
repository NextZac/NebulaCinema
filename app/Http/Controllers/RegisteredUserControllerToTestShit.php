<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserControllerToTestShit extends Controller
{
    public function register()
    {
        return Inertia::render("Auth/Register");
    }

    public function create(RegisterRequest $request): Response
    {
        return response()->noContent();
    }
}
