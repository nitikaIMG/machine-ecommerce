<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSeller extends Model
{
    use HasFactory;

    const QUOTATION = 'quotation';
    const PENDING = 'pending';
    const CONFIRMED = 'confirmed';
    const DELIVERED = 'delivered';
    const CANCELLED = 'cancelled';

    protected $table = 'order_sellers';

    public function scopeQuotation($query)
    {
        return $query->where('status', self::QUOTATION);
    }

    public function scopeNoQuotation($query)
    {
        return $query->where('status', '!=', self::QUOTATION);
    }

    public function scopeWithStatus(Builder $query, $status = 'pending')
    {
        return $query->where('status', $status);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function shop()
    {
        return $this->belongsTo(UserShop::class, 'shop_id');
    }

    public function isPendingAttribute()
    {
        return $this->status === self::PENDING;
    }

    public function getItemsAttribute()
    {
        return $this->order->items;
    }
}
