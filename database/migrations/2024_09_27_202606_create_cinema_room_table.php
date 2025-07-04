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
        Schema::create('cinema_room', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('cinema_id')->constrained()->onDelete('cascade');
            $table->integer('seats');
            $table->integer('rows');
            $table->integer('columns');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_room');
    }
};
