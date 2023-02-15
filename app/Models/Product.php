<?php

namespace App\Models;

use App\ModelFilters\ProductFilter;
use App\Models\Traits\ScopeIsActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable, ProductFilter, ScopeIsActive;

    protected $table = 'products';

    protected $translatedAttributes = ['title', 'short_description', 'description', 'additional_info'];

    protected $guarded = ['id'];

    public function getTranslationRelationKey()
    {
        return 'product_id';
    }

    // it doesn't directly belong to a parnet category like automoblie
    // it belongs to a child category like plugs or wire etc.
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    // get one top image
    public function product_image()
    {
        return $this->hasOne(ProductImage::class, 'product_id')
            ->orderBy('id', 'DESC');
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    // obsolete
    public function favourties()
    {
        return $this->belongsToMany(Product::class, 'user_favourite_products', 'product_id', 'product_id')
            ->withPivot(['user_id', 'product_id']);
    }

    // sellers that are serving this product
    public function sellers()
    {
        return $this->belongsToMany(User::class, SellerProduct::class, 'product_id', 'seller_id');
    }

    // shops that are serving this product
    public function shops()
    {
        return $this->belongsToMany(UserShop::class, SellerProduct::class, 'product_id', 'shop_id');
    }

    public function seller_products()
    {
        return $this->hasMany(SellerProduct::class, 'product_id');
    }

    public function seller_product()
    {
        return $this->hasOne(SellerProduct::class, 'product_id')
            ->orderBy('created_at', 'DESC');
    }

    public function scopeByCategory($query, $categories)
    {
        return $query->whereIn('product_category_id', (array)$categories);
    }

    // in-case the product is not being served directly via a shop
    // public function shops()
    // {
    //     return $this->belongsToMany(UserShop::class, SellerProduct::class, 'product_id', 'seller_id', null, 'user_id')
    //         ->withPivot(['price_type', 'price', 'qty', 'status']);
    // }

    // obsolete
    public function isFavForUser(?User $user = null)
    {
        if( empty($user) ) {
            return false;
        }

        return $this->favourties->where('pivot.user_id', $user->id)->isNotEmpty();
    }

    public static function booted()
    {
        // static::addGlobalScope('active', function (Builder $builder) {
        //     $builder->where('status', '1');
        // });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


}
