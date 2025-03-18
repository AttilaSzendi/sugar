<?php

namespace App\Http\Resources;

use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Screening */
class ScreeningResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'availableSeats' => $this->available_seats,
            'movieId' => $this->movie_id,
            'movie' => new MovieResource($this->whenLoaded('movie')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
