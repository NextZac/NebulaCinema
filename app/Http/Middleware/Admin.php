<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->can('access admin panel')) {
            return $next($request);
        }

        // Optionally, redirect to a specific 'unauthorized' page or back with an error
        // For now, redirecting to home.
        return redirect("/")->with('error', 'You do not have permission to access this page.');
    }
}
