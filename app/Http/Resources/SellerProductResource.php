<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Product listing (or detail) shown to a seller
// Table - "products"
class SellerProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cover_image = $this->cover_image
            ? storage_url($this->cover_image)
            : sample_img(1920, 1050, $this->title ?? '');

        $seller_product = $this->relationLoaded('seller_product')
            ? $this->seller_product
            : null;

        if( !empty($seller_product) ) {
            $seller_product = [
                'seller_product_id' => $seller_product->id,
                'price' => ($seller_product->price ? price_format($seller_product->price)
                    : '0.00'),
                'currency' => 'AED', //TODO: user currency
                'price_type' => $seller_product->price_type,
                'qty' => intval($seller_product->qty)
            ];
        }

        return \array_merge([
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'image' => $cover_image,
            $this->mergeWhen(!empty($seller_product), $seller_product)
        ], $this->additional);
    }
}
