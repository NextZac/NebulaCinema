<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render("Auth/Login");
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return Inertia::location(route("admin.dashboard"));
    }

    public function destroy(Request $request)
    {
        Auth::guard("web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route("Home");
    }
}
