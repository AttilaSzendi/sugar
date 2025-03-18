<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Movie */
class MovieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'ageLimit' => $this->age_limit,
            'language' => $this->language,
            'coverImage' => $this->cover_image,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'screenings' => ScreeningResource::collection($this->whenLoaded('screenings'))
        ];
    }
}
