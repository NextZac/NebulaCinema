<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render("Auth/Login");
    }

    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route("admin");
    }

    public function destroy(Request $request): Response
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("Home");
    }
}
