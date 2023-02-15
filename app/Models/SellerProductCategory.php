<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProductCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'seller_product_categories';
}
