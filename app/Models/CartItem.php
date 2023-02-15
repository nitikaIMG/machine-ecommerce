<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $guarded = ['id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function seller_product()
    {
        return $this->belongsTo(SellerProduct::class, 'seller_product_id');
    }

    public function seller()
    {
        return $this->hasOneThrough(User::class, SellerProduct::class, 'id', 'id', 'seller_product_id', 'seller_id');
    }

    public function shop()
    {
        return $this->hasOneThrough(UserShop::class, SellerProduct::class, 'id', 'id', 'seller_product_id', 'shop_id');
    }

    public function biddings()
    {
        return $this->hasMany(CartItemBidding::class, 'cart_item_id')->latest();
    }
}
