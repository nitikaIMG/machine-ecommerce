<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Product listing (or detail) shown to a customer
// Table - "seller_products"
class CustomerProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = $this->resource->product;

        $seller = '';

        $shops = $this->resource->relationLoaded('shop')
            ? [$this->resource->shop]
            : [];

        if( empty($shops) ) {
            $shops = $product->relationLoaded('shops')
                ? $product->shops
                : [];
        } else {
            $shops = $this->resource->relationLoaded('shops')
                ? $this->resource->shops
                : [];
        }

        foreach( $shops as $shop ) {
            $seller .= "{$shop->shop_name}, ";
        }

        return array_merge([
            'id' => $this->id, // seller_products->id
            'title' => $product->title,
            'short_description' => $product->short_description,
            // TODO: price to be provided by the seller
            'price' => $this->price ? price_format($this->price) : '0.00',
            'currency' => 'AED', //TODO: user currency
            'price_type' => $this->price_type,
            'image' => $product->cover_image
                ? storage_url($product->cover_image)
                : sample_img(480, 360),
            'seller_id'=> isset($product->seller_id) ? $product->seller_id : $this->resource->shop->user_id,
            'seller' => rtrim($seller, ', ')
        ], $this->additional);
    }
}
