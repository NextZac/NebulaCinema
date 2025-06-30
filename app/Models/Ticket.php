<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_session_id',
        'seat_number',
        'price',
        'is_paid',
        'is_used',
        'qr_code_identifier',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_paid' => 'boolean',
        'is_used' => 'boolean',
    ];

    /**
     * Get the user that owns the ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the movie session for the ticket.
     */
    public function movieSession()
    {
        return $this->belongsTo(MovieSession::class);
    }
    
    /**
     * Get the payment history associated with the ticket.
     * Assuming a one-to-one or one-to-many relationship might exist.
     * If a ticket can have multiple payment attempts, it would be hasMany.
     * If a single payment record is tied to this ticket, it's hasOne.
     */
    public function paymentHistory()
    {
        // Example: Assuming one ticket has one primary payment record. Adjust if needed.
        return $this->hasOne(PaymentHistory::class);
        // Or if multiple payments: return $this->hasMany(PaymentHistory::class);
    }
}
