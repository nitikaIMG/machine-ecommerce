<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemBiddingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = auth()->user() ?? auth('api')->user();

        return [
            'id' => $this->id,
            'customer' => $user
                ? ($this->customer->id == $user->id ? __('You') : $this->customer->name)
                : $this->customer->name,
            'seller' => $user
                ? ($this->seller->id == $user->id ? __('You') : $this->seller->name)
                : $this->seller->name,
            'bid' => price_format($this->bid),
            'action' => $this->action,
            'open_for_bidding' => $this->resource->isOpenForBidding
        ];
    }
}
