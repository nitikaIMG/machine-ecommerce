<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
class SellerProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'seller_products';

    protected $guarded = ['id'];

    // protected $dates = ['deleted_at'];  

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function shop()
    {
        return $this->belongsTo(UserShop::class, 'shop_id');
    }

  public function shopWithTrash()
    {
        return $this->belongsTo(UserShop::class, 'shop_id')->withTrashed();
    }


    // if shop_id null; then this seller is selling this product in every shop
    public function shops()
    {
        return $this->hasMany(UserShop::class, 'user_id', 'seller_id');
    }

    public function favourties()
    {
        return $this->belongsToMany(self::class, 'user_favourite_products', 'seller_product_id', 'seller_product_id')
            ->withPivot(['user_id', 'seller_product_id']);
    }

    public function isFavForUser(?User $user = null)
    {
        if( empty($user) ) {
            return false;
        }

        return $this->favourties->where('pivot.user_id', $user->id)->isNotEmpty();
    }

    public function isBid()
    {
        return $this->price_type == 'bid';
    }

    public function isFixed()
    {
        return ! $this->isBid();
    }

    public static function booted()
    {
        // static::addGlobalScope('active', function(Builder $builder) {
        //     $builder->where('status', 1);
        // });

        // static::addGlobalScope('has_product', function(Builder $builder) {
        //     $builder->has('product');
        // });
    }
}
