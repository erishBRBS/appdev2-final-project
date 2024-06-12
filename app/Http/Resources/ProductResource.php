<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'product_name' => $this->product_name,
            'size_id' => $this->size_id,
            'price' => $this->price,
            'description' => $this->description,
            'quantity_id' => $this->quantity_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
