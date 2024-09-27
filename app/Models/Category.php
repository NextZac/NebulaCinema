<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Movie;

class Category extends Model
{
    use HasFactory;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_category');
    }
}
