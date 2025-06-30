<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('movie_session_id')->constrained('movie_sessions')->onDelete('cascade');
            $table->string('seat_number'); // e.g., "A1", "B12"
            $table->decimal('price', 8, 2);
            $table->boolean('is_paid')->default(false); // Added based on common needs
            $table->boolean('is_used')->default(false); // For ticket status
            $table->uuid('qr_code_identifier')->nullable()->unique(); // For QR code identification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
