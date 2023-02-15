<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ShopRating;
class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
	$shop_image = isset($this->photos[0]->photo) ? $this->photos[0]->photo : sample_img(1600, 1050, $this->shop_name ?? '');
        $distance = doubleval($this->user_shop_distance ?? 0);

        if( $distance > 0 ) {
            $distance = $distance * 1.609344;
        }
//$distance =  GetDrivingDistance(21.3181081,17.3983774,83.02217399999999,78.5582652);

        $distance = number_format($distance, 2, '.', '');

        $additional = $this->relationLoaded('_additional_info')
            ? $this->_additional_info
            : ['image'=>$shop_image];

        // $photos = $this->relationLoaded('photos')
        //     ? $this->photos->map(function($photo) {
        //         return storage_url($photo->photo);
        //     })->flatten(1)->toArray()
        //     : [];

	
        $ratings_count = ShopRating::where('shop_id',$this->id)->count();
        $rate_total = ShopRating::where('shop_id',$this->id)->sum('rate');
        if($ratings_count != 0 and $rate_total != 0){
        $overall_average = $rate_total/$ratings_count;
        }else{
            $overall_average =5;
        }

        $photos_arr = $this->photos;
        $photos = $this->relationLoaded('photos')
            ? $photos_arr->map(function($photos_arr) {
                return storage_url($photos_arr->photo);
            })->flatten(1)->toArray()
            : [];

        $categories = $this->relationLoaded('categories')
            ? ProductCategoryResource::collection($this->categories)
            : false;

        return [
            'id' => $this->id,
            'seller_id' => $this->user_id,
            'shop_owner' => $this->shop_owner,
            'shop_name' => $this->shop_name,
            'shop_contact' => $this->shop_contact,
            'shop_email' => $this->shop_email,
            'shop_logo' => $shop_image
                ? storage_url($shop_image)
                : sample_img(1600, 1050, $this->shop_name ?? ''),
            'distance' => $distance,
            'distance_unit' => 'KM',
            'rating' =>  $overall_average,
            'offer' => 'Upto 20% off',
            'order_timing' => 'You can order for today at 10:00AM',
            'registration_no' => $this->registration_no,
            'address' => $this->address,
            'working_hours' => $this->working_hours,
            'working_days' => array_filter(explode(',',$this->working_days)),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'additional' => $additional,
            'images' => $photos,
            $this->mergeWhen($categories !== false, [
                'categories_shop' => $categories
            ]),
            $this->mergeWhen(model_has_property($this->resource, 'is_current_users_fav'), [
                'added_to_favourite' => $this->is_current_users_fav
            ])
        ];
    }
}
