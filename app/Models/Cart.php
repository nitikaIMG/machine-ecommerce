<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'carts';

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function items_with_product()
    {
        return $this->items()->with(['seller_product']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isSellerProductInCart(SellerProduct $seller_product)
    {
        return $this->items->contains('seller_product_id', $seller_product->id);
    }

    public function getTotalAmountAttribute()
    {
        $total = 0.00;

        foreach( $this->items_with_product as $item ) {
            $seller_product = $item->seller_product;

            if( empty($seller_product) ) continue;

            if( $price = floatval($seller_product->price) ) {
                $total += !empty($item->qty)
                    ? $price * intval($item->qty)
                    : $price;
            }
        }

        return price_format($total);
    }

    public function getTotalQtyAttribute()
    {
        if( isset($this->items_with_product) ) {
            return $this->items_with_product->sum('qty');
        }

        return $this->items->sum('qty');
    }

    public function getTotalAttribute()
    {
        if( isset($this->items_with_product) ) {
            return $this->items_with_product->count();
        }

        return $this->items->count();
    }
}
