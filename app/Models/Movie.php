<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function sessions()
    {
        return $this->hasMany(MovieSession::class);
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

    public function scopeFilter($query, array $filters)
    {
        foreach ($filters as $filter => $value) {
            if (empty($value) || $value === "all") {
                continue;
            }

            switch ($filter) {
                case "cinema":
                    $query->where("cinema", $value);
                    break;

                case "categories":
                    $query->whereHas("categories", function ($q) use ($value) {
                        $q->whereIn("name", $value);
                    });
                    break;

                case "age_rating":
                    $query->whereHas("movie", function ($q) use ($value) {
                        $q->whereIn("age_rating", $value);
                    });
                    break;

                default:
                    break;
            }
        }

        return $query;
    }
}
