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

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            "movie_category",
            "movie_id",
            "category_id"
        );
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("trailer")->singleFile();
        $this->addMediaCollection("pictures");
    }

    public function getImagePathAttribute()
    {
        $media = $this->getFirstMedia("pictures");
        return $media ? $media->getUrl() : null; // Return the URL of the first image, or null if not available
    }
}
