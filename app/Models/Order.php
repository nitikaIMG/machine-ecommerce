<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $guarded = ['id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }

    public function items()
    {
        return $this->cart_items();
    }

    // get just one item
    public function item()
    {
        return $this->hasOne(CartItem::class, 'cart_id', 'cart_id')->latest();
    }

    // individuals seller orders
    public function orders()
    {
        return $this->hasMany(OrderSeller::class, 'order_id');
    }

    // individuals seller quotations
    public function quotations()
    {
        return $this->orders()->quotation();
    }

    public function scopeQuotation(Builder $query)
    {
        $query->whereHas('orders', function(Builder $query) {
            $query->quotation();
        });
    }

    public function scopeNoQuotation(Builder $query)
    {
        $query->whereHas('orders', function(Builder $query) {
            $query->noQuotation();
        });
    }

    public function scopeWithStatus(Builder $query, $status = 'pending')
    {
        $query->whereHas('orders', function(Builder $query) use($status) {
            $query->withStatus($status);
        });
    }

    public function getStatusAttribute()
    {
        $orders = $this->orders->where('status', '!=', 'quotation');

        $status = '';

        foreach( $orders as $order ) {
            if( $order->pending ) {
                return __('status.pending');
            }

            $status = $order->status;
        }

        return __("status.{$status}");
    }

 public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

 public function customer_address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

}
