<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use DB;
// use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
// use Astrotomic\Translatable\Translatable;

class UserShop extends Model
{
    use HasFactory;

    protected $table = 'user_shops';

    public $timestamps = false;
    // protected $translatedAttributes = ['overview','services'];
    // public function getTranslationRelationKey()
    // {
    //     return 'user_shop_id';
    // }  

    protected $fillable = [
        'user_id', 'shop_owner', 'shop_name', 'shop_contact',
        'shop_email', 'registration_no', 'country',
        'state', 'address_1', 'address_2', 'id_document',
        'is_primary', 'latitude', 'longitude',
        'working_hours_from', 'working_hours_to', 'working_days'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favourties()
    {
        return $this->belongsToMany(UserShop::class, 'user_favourite_shops', 'user_shop_id', 'user_shop_id')
            ->withPivot(['user_id', 'user_shop_id']);
    }

    public function isFavForUser(?User $user = null)
    {
        if( empty($user) ) {
            return false;
        }

        return $this->favourties->where('pivot.user_id', $user->id)->isNotEmpty();
    }

    // parent categories (automobiles, electricals, etc) that this shop serves
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'seller_product_categories', 'user_shop_id', 'product_category_id');
    }

    // child categories (plugs, wires, pipes, etc) that this shop serves
    public function sub_categories()
    {
        return $this->hasManyThrough(
            ProductCategory::class,
            SellerProductCategory::class,
            'user_shop_id',
            'id',
            'id',
            'product_category_id'
        );
    }

    public function photos()
    {
        return $this->hasMany(UserShopPhoto::class, 'user_shop_id');
    }

    // shops where its selelr is active
    public function scopeActiveSeller($query)
    {
        return $query->whereHas('seller', function($query) {
                // User::scopeFullyActive()
                $query->fullyActive()
                    ->where('onboarded', 1);
            });
    }

    public function scopeWithDistance($query, $latitude, $longitude)
    {
        return $query->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select("*")
            ->selectRaw(
                "SQRT(POW(69.1 * (latitude - ?), 2) + POW(69.1 * (? - longitude) * COS(latitude / 57.3), 2)) AS user_shop_distance",
                [$latitude, $longitude]
            );
    }

    public function search($query, $latitude, $longitude)
    {
        return $query->where('latitude',$latitude)
            ->where('longitude',$longitude);
            
    }

    public function getAddressAttribute()
    {
        $address = $this->address_1 ?? '';

        if( $this->city ) {
            $address .= ", {$this->city}";
        }
        if( $this->state ) {
            $address .= ", {$this->state}";
        }
        if( $this->country ) {
            $address .= ", {$this->country}";
        }

        return ltrim($address, ', ');
    }

    public function getWorkingHoursAttribute()
    {
        if( $this->working_hours_from && $this->working_hours_to ) {
            return "{$this->working_hours_from} - {$this->working_hours_to}";
        }
        return '-';
    }

    public function getWorkingHours()
    {
        if( $this->working_hours_from && $this->working_hours_to ) {
            return "{$this->working_hours_from} - {$this->working_hours_to}";
        }
        return '-';
    }

    public function getSubCategoriesAttribute()
    {
        return $this->categories->map->children->flatten(1);
    }

    // public static function booted()
    // {
    //     static::addGlobalScope('active', function(Builder $builder) {
    //         $builder->activeSeller();
    //     });
    // }

    public static function clearCache(?User $user = null)
    {
        $page = 1;
        $failSafe = 10000;

        while( $page > $failSafe) {
            $key = $user
                ? "shops_all.{$page}.{$user->id}"
                : "shops_all.{$page}";

            if( Cache::has($key) ) {
                Cache::forget($key);
            } else {
                break;
            }
            $page++;
        }
    }

    public static function getByDistance($lat, $lng, $distance)
    {
      $results = DB::select(DB::raw('SELECT id,latitude,longitude, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM user_shops HAVING distance < ' . $distance . ' ORDER BY distance') );

      return $results;
    }

    public static function getByDistanceShop($lat, $lng, $distance,$shoptitle)
    {
        
        $results = DB::table('user_shops')
    ->selectRaw('id,latitude,longitude, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance')
    // ->groupBy('distance')
    ->where('shop_name', 'Like', '%' . $shoptitle . '%')
    ->havingRaw('distance < ?', [1])
    ->get();
     
      // $results = DB::select(DB::raw('SELECT id,latitude,longitude, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM user_shops HAVING distance < ' . $distance . ' ORDER BY distance') );
        //where shop_name  LIKE %'. $shoptitle .'%
        // $results->where('shop_name', 'Like', '%' . $shoptitle . '%');
      
      return $results;
    }
}
