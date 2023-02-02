<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sizes' => new SizeCollection($this->whenLoaded('sizes')),
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'links' => [
                'update' => route('api_product_update', ['product' => $this->slug]),
            ],
        ];
    }

    public function with($request): array
    {
        return [
            'meta' => [
                'links' => [
                    'index' => route('api_product_index'),
                    'create' => route('api_product_create'),
                ],
            ],
        ];
    }
}
