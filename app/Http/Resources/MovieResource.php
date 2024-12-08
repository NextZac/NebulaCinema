<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MovieSessionResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'titleEng' => $this->titleEng,
            'description' => $this->description,
            'length' => $this->length,
            'cast' => json_decode($this->cast),
            'author' => $this->author,
            'director' => $this->director,
            'age_rating' => $this->age_rating,
            'release_date' => $this->release_date,
            'trailer' => $this->trailer,
            'sessions' => $this->sessions,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
