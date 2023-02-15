<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShopPhoto extends Model
{
    use HasFactory;

    protected $table = 'user_shop_photos';
    protected $guarded = ['id'];
    

    public $timestamps = false;

    public function user_shop()
    {
        return $this->belongsTo(UserShop::class, 'user_shop_id');
    }
}
