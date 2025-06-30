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

    protected $fillable = [
        "title",
        "titleEng",
        "description",
        "release_date",
        // "trailer", // replaced by trailer_url
        "duration", // Correctly using duration now
        // "length", // Removed, replaced by duration
        "age_rating",
        "author",
        "director",
        "trailer_url", // Aligned with migration
        "cast",
    ];

    protected $casts = [
        'release_date' => 'date',
        'duration' => 'integer',
        // 'cast' => 'array', // If you decide to store cast as JSON and use text column
    ];

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
        return $media ? $media->getUrl() : null;
    }
    public function scopeFilter($query, $filters)
    {
        if (isset($filters["release_date"])) {
            $query->whereDate(
                "release_date",
                $filters["release_date"][0],
                $filters["release_date"][1]
            );
        }

        if (!empty($filters["categories"])) {
            $query->where("categories", $filters["categories"]);
        }

        return $query;
    }
}
