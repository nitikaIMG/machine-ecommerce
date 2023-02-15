<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNotiifcation extends Model
{
    use HasFactory;

    protected $table = 'order_notiifcations';



      public function user()
    {
        
        return $this->hasOne(User::class,'id','user_id');

        
    }

      public function seller()
    {
        
        return $this->hasOne(User::class,'id','seller_id');

        
    }


      public function orderseller()
    {
        
        return $this->hasOne(OrderSeller::class,'order_id','order_id');

        
    }
}
