<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TicketController extends Controller
{
    public function __construct()
    {
        // Apply permission middleware
        // Users with 'manage_tickets' permission can access this controller
    }

    public static function middleware(): array
    {
        return [
            'can:manage_tickets'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with(['user:id,name,email', 'movieSession.movie:id,title', 'movieSession.cinemaRoom:id,name'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Admin/Tickets/Index', [
            'tickets' => $tickets,
            'filters' => $request->only(['search', 'status']) // Example for potential filters
        ]);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Ticket $ticket)
    // {
    //     // Eager load relationships for detailed view
    //     $ticket->load(['user', 'movieSession.movie', 'movieSession.cinemaRoom', 'paymentHistory']);
    //     return Inertia::render('Admin/Tickets/Show', [
    //         'ticket' => $ticket
    //     ]);
    // }
}
