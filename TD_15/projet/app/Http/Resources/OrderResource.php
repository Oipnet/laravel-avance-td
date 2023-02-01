<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'product' => new ProductResource($this->whenLoaded('product')),
            'size' => new SizeResource($this->whenLoaded('size')),
            'order_state' => new OrderStateResource($this->whenLoaded('orderState')),
            'price_in_cents' => $this->price_in_cents,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'links' => [],
        ];
    }
}
