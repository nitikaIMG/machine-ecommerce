<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShopTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['user_shop_id','locale','overview','services'];

    protected $table = 'user_shop_translations';

    public $timestamps = false;
}
