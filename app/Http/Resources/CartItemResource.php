<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $item = new CustomerProductResource($this->seller_product);

        $total_amount = 0;

        if( $price = floatval($this->price) ) {
            $total_amount = $price * ($this->qty ?? 1);
        }

        $item->additional([
            'quantity' => $this->qty,
            'total_amount' => price_format($total_amount)
        ]);

        return \array_merge($item->toArray($request), $this->additional);
    }
}
