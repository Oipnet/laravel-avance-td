<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'slug' => $this->slug,
            'links' => [],
        ];
    }

    public function with($request): array
    {
        return [
            'meta' => [
                'links' => [
                    'index' => route('api_category_index'),
                ],
            ],
        ];
    }
}
