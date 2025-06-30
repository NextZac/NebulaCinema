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
            $table->string("titleEng")->nullable();
            $table->text("description"); // Changed from string to text for potentially longer descriptions
            $table->integer("duration")->nullable(); // Changed from length (time) to duration (integer, minutes)
            $table->text("cast")->nullable(); // Changed from json to text, assuming comma-separated string
            $table->string("author")->nullable();
            $table->string("director")->nullable();
            $table->string("age_rating")->nullable();
            $table->date("release_date")->nullable();
            $table->string("trailer_url", 500)->nullable(); // Changed from trailer to trailer_url, increased length
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("movies");
    }
};
