<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return \array_merge([
            'order_no' => $this->order_no,
            'date' => $this->created_at->format('d M, Y - h:i A'),
            'date_str' => $this->created_at->diffForHumans(),
	    'created_at' => $this->created_at,
        ], $this->additional);
    }
}
