<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItemBidding extends Model
{
    use HasFactory;

    const ACCEPTED = 1;
    const REJECTED = -1;
    const NO_ACTION = 0;

    protected $table = 'cart_item_biddings';

    protected $guarded = ['id'];

    public function scopeAccepted(Builder $query, $status = 0)
    {
        $query->where('accepted', $status);
    }

    public function scopeRejected(Builder $query)
    {
        $query->accepted(self::REJECTED);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function cart_item()
    {
        return $this->belongsTo(CartItem::class, 'cart_item_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    // public function getSiblingsAttribute()
    // {
    //     return $this->_siblings;
    // }

    public function siblings()
    {
        return $this->hasMany(CartItemBidding::class, 'cart_id', 'cart_id')
            ->where('id', '!=', $this->id)
            ->latest()
            ->orderBy('id', 'DESC');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'cart_id', 'cart_id');
    }

    public function seller_order()
    {
        return $this->hasOne(OrderSeller::class, 'shop_id', 'shop_id')
            ->where('seller_id', $this->seller_id)
            ->where('shop_id', $this->shop_id);
    }

    public function get_seller_order($order_id)
    {
        return $this->hasOne(OrderSeller::class, 'shop_id', 'shop_id')
            ->where('seller_id', $this->seller_id)
            ->where('shop_id', $this->shop_id)
            ->where('order_id', $order_id)
            ->get()
            ->first();
    }

    public function getActionAttribute()
    {
        if( $this->accepted === self::NO_ACTION ) {
            return __('No action taken');
        }

        return $this->accepted == 1
            ? __('Accepted')
            : __('Rejected');
    }

    public function getIsBidAcceptedAttribute()
    {
        return $this->accepted === self::ACCEPTED;
    }

    public function getIsOpenForBiddingAttribute()
    {
        return $this->accepted === self::REJECTED;
    }

    public function getActionTakenAttribute()
    {
        return $this->accepted !== self::NO_ACTION;
    }

    public function getNoActionTakenAttribute()
    {
        return $this->accepted === self::NO_ACTION;
    }

    public function getIsBidRejectedAttribute()
    {
        return $this->accepted === self::REJECTED;
    }
}
