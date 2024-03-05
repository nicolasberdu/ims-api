<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'product_name' => $this->product_name,
            'description' => $this->description,
            'category_code' => ($this->category_code) ? $this->category_code : null,
            'category_url' => ($this->category_code) ? route('categories.show', ['category' => $this->category_code]) : null,
            'price' => $this->price,
            'is_enabled' => $this->is_enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'url' => route('products.show', ['product' => $this->code]),
        ];
    }
}
