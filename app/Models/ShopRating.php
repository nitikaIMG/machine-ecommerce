<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRating extends Model
{
    use HasFactory;

    protected $table = 'shop_rating';

    protected $fillable = ['rate', 'review', 'user_id', 'seller_id', 'shop_id', 'created_at', 'updated_at'];
}
