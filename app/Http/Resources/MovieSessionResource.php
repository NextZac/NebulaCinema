<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieSessionResource extends JsonResource
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
            'movie_id' => $this->movie_id,
            'start_time' => $this->start_time,
            'main_price' => $this->main_price,
            'vip_price' => $this->vip_price,
            'language' => $this->language,
            'subtitles' => $this->subtitles,
            'seats' => $this->seats,
            'format' => $this->format,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'cinema_name' => $this->cinemaRoom->cinema->name,
            'cinema_room' => $this->cinemaRoom->name,
        ];
    }
}
