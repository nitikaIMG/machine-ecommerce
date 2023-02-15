<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Models\User;
use App\Models\UserShop;

class ShopRepository
{
    // TODO: change radius and cache
    const MAX_DISTANCE = 0; // in miles
    const CACHE_TIME = 0;

    protected $user;

    protected $productCategory;

    protected $filters = [];

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setProductCategory(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
        return $this;
    }

    public function setFilters(array $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    // TODO: on user location update; clear cache
    // TODO: on any product info update; clear cache
    // TODO: check if tag is supported on cache
    public function all()
    {
        $page = request()->get('page', 1);
        $limit = request()->get('limit', 15);

        $user = $this->user;
        $productCategory = $this->productCategory;
        $filters = $this->filters;

        $key = $user
            ? "shops_all.{$page}.{$user->id}"
            : "shops_all.{$page}";

        return cache()
            // ->tags(["shops_all.{$user->id}"])
            ->remember($key, static::CACHE_TIME, // 6 hours
                function() use($productCategory, $filters, $user,$limit) {

                    $query = UserShop::query()
                        ->with(['seller', 'favourties']);

                    if( $productCategory ) {
                        $query->whereHas('categories', function($query) use($productCategory) {
                            $query->where('product_categories.id', $productCategory->id);
                        });
                    }

                    $radius = static::MAX_DISTANCE;

                    foreach( $filters as $key => $value ) {
                        switch( $key ) {
                            case 'radius':
                                $radius = doubleval($value);
                                $radius -= $radius * 1.609344;
                                break;

                            // case 'ratings'
                        }
                    }

                    if( $user && $user->latitude && $user->longitude ) {

                        $query->whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->select("*")
                            ->selectRaw(
                                "SQRT(POW(69.1 * (latitude - ?), 2) + POW(69.1 * (? - longitude) * COS(latitude / 57.3), 2)) AS user_shop_distance",
                                [$user->latitude, $user->longitude]
                            );

                        if( $radius > 0 ) {
                            $query->havingRaw('user_shop_distance < ?', [$radius]);
                        }

                        $query->orderBy('user_shop_distance', 'ASC');
                    }

                    return $query
                        ->orderBy('user_shops.id', 'DESC')
                        ->paginate($limit)
                        ->through(function($shop) use($user) {
                            
                            if( $user ) {
                                $shop->is_current_users_fav = $shop->isFavForUser($user);
                            }

                            return $shop;
                        });

                });
    }
 // for search

 public function allSearch($lat,$lng,$shoptitle,$userId)
 {
     $page = request()->get('page', 1);

      $user = $this->user;
     $productCategory = $this->productCategory;
     $filters = $this->filters;

     $key = $user
         ? "shops_all.{$page}.{$user->id}"
         : "shops_all.{$page}";

     return cache()
         // ->tags(["shops_all.{$user->id}"])
         ->remember($key, static::CACHE_TIME, // 6 hours
             function() use($productCategory, $filters, $user, $lat,$lng,$shoptitle,$userId) {

                 $distance = 1;
                 $queryshop = array();                        
                 // $queryshop = UserShop::getByDistance($lat, $lng, $distance);
                 
                 if(!empty($shoptitle) && empty($lat) && empty($lat)){

                     $queryshop = UserShop::where('shop_name', 'LIKE', "%{$shoptitle}%")->get();
                 }

                 if(!empty($lat) && !empty($lat) && empty($shoptitle)){

                 $queryshop = UserShop::getByDistance($lat, $lng, $distance);    
                 
                 }

                  if(!empty($lat) && !empty($lat) && !empty($shoptitle)){

                 $queryshop = UserShop::getByDistanceShop($lat, $lng, $distance,$shoptitle);    
                 
                 }

                 $ids = [];

                     foreach($queryshop as $q)
                     {
                       array_push($ids, $q->id);
                     }
                     
                 $query = UserShop::query()
                     ->with(['seller', 'favourties']);

                 if( $productCategory ) {
                     $query->whereHas('categories', function($query) use($productCategory) {
                         $query->where('product_categories.id', $productCategory->id);
                     });
                 }

                 $radius = static::MAX_DISTANCE;

                 foreach( $filters as $key => $value ) {
                     switch( $key ) {
                         case 'radius':
                             $radius = doubleval($value);
                             $radius -= $radius * 1.609344;
                             break;

                         // case 'ratings'
                     }
                 }
                 
                 if(!empty($userId)){

                 $userData=User::where('id',$userId)->first();
                 }
                 $query->whereIn( 'id', $ids);
                 // return $userData->longitude;
                 if( $userData && $userData->latitude && $userData->longitude ) {

                     $query->whereNotNull('latitude')
                         ->whereNotNull('longitude')
                         ->select("*")
                         ->selectRaw(
                             "SQRT(POW(69.1 * (latitude - ?), 2) + POW(69.1 * (? - longitude) * COS(latitude / 57.3), 2)) AS user_shop_distance",
                             [$userData->latitude, $userData->longitude]
                         );
                       //   ->selectRaw(
                       //       "SQRT(POW( 3959 * acos( cos( radians(' . " . $lat ." . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' ." .$lng. " . ') ) + sin( radians(' . " . $lat ." .') ) * sin( radians(latitude) ) ) ) ) AS distance",
                       // );
                          // $radius =  1.609344;
                     if( $radius > 0 ) {
                         $query->havingRaw('user_shop_distance < ?', [$radius]);
                         // $query->havingRaw('distance < ?', [$distance]);
                     }

                     $query->orderBy('user_shop_distance', 'ASC');
                 }

                 // else{
                 //     $query->whereNotNull('latitude')
                 //         ->whereNotNull('longitude')
                 //         ->whereIn( 'id', $ids)
                 //         ->select("*");
                         

                 //     $query->orderBy('user_shop_distance', 'ASC');

                 // }

                 return $query
                     ->orderBy('user_shops.id', 'DESC')
                     ->paginate(1000)
                     ->through(function($shop) use($user) {
                         
                         if( $user ) {
                             $shop->is_current_users_fav = $shop->isFavForUser($user);
                         }

                         return $shop;
                     });

             });
 }

    public function find($id)
    {
        $user = $this->user;

        $shop = UserShop::query();

        if( $user && $user->latitude && $user->longitude ) {
            
            $shop->select("*")->selectRaw(
                "SQRT(POW(69.1 * (latitude - ?), 2) + POW(69.1 * (? - longitude) * COS(latitude / 57.3), 2)) AS user_shop_distance",
                [$user->latitude, $user->longitude]
            );
        }

        return $shop->firstWhere('id', $id);
    }

}