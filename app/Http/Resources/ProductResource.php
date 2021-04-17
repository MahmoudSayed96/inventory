<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'image' => $this->image,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'stock' => $this->stock,
            'quantity' => $this->quantity,
            'category' => $this->when($this->category, $this->category),
            'supplier' => $this->when($this->supplier, $this->supplier),
            'buying_date' => $this->buying_date,
            'category_id' => $this->when($this->category_id, $this->category_id),
            'supplier_id' => $this->when($this->supplier_id, $this->supplier_id),
        ];
    }
}
