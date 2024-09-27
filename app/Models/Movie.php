<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Category;

class Movie extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function categories() {
        return $this->belongsToMany(Category::class, 'movie_category');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('trailer')
            ->singleFile();
        $this->addMediaCollection('pictures');
    }
}
