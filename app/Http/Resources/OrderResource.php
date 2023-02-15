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
        $seller_orders = $this->relationLoaded('orders')
            ? $this->orders->map(function($order) {
                return [
		    'shop_id' => $order->shop->id,
                    'seller_id' => $order->shop->user_id,
		    'seller_name' => $order->shop->user->name,
                    'seller' => $order->shop->shop_name,
                    'status' => $order->status
                ];
            })
            : false;

	if(isset($this->address_id)){
	  $customer_address = $this->customer_address->name.",".$this->customer_address->address_1.",".$this->customer_address->address_2.",".$this->customer_address->city.",".$this->customer_address->state.",".$this->customer_address->country.",".$this->customer_address->zip;
	}else{
	$customer_address = "";
	}
	

        return array_merge([
            'id' => $this->id,
            'order_no' => $this->order_no,
            'date' => $this->created_at->format('d M, Y - h:i A'),
            'date_str' => $this->created_at->diffForHumans(),
	    'customer' => $this->customer->name,
	    'seller' => $this->seller_name,
	    'delivery_type' => $this->delivery_type,
	    'customer_address' => $customer_address,
            $this->mergeWhen(
                !empty($this->top_item),
                ['item' => new CartItemResource($this->top_item)]
            ),
            $this->mergeWhen(
                $seller_orders !== false,
                ['seller_orders' => $seller_orders]
            ),
            'status' => $this->status
        ], $this->additional);
    }
}