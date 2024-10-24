<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("movies", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->time("length");
            $table->json("cast");
            $table->string("author");
            $table->string("director");
            $table->string("age_rating");
            $table->date("release_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists("movie_session");
        // Schema::dropIfExists("movies");
    }
};
