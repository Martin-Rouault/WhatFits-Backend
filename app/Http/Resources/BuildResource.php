<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'user'  => new UserPublicResource($this->whenLoaded('user')),
            'car_model' => [
                'id'    => $this->whenLoaded('carModel')?->id,
                'name'  => $this->whenLoaded('carModel')?->name,
                'make'  => $this->whenLoaded('carModel')?->make?->name
            ],
            'wheel' => [
                'id'    => $this->whenLoaded('wheel')?->id,
                'name'  => $this->whenLoaded('wheel')?->name,
                'brand' => $this->whenLoaded('wheel')?->wheel_brand?->name,
            ],
            'car_year'     => $this->car_year,
            'diameter'     => $this->diameter,
            'width'        => $this->width,
            'likes_count'  => $this->whenLoaded('likes', fn() => $this->likes->count()),
            'photos'       => $this->whenLoaded('photos', fn() => $this->photos->map(fn($photo) => [
                'url'   => $photo->photo_url,
                'order' => $photo->display_order
            ])),
            'created_at'   => $this->created_at
        ];
    }
}
