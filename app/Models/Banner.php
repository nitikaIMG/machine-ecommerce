<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Cache;


class Banner extends Model
{
    use HasFactory,Translatable;

    protected $table = 'banners';

    // protected $guarded = ['id'];
    protected $translatedAttributes = ['title','short_description'];
    protected $fillable =['image'];
    public function getTranslationRelationKey()
    {
        return 'banner_id';
    }    

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public static function booted()
    {
        static::saved(function() {
            static::clearCache();
        });

        static::deleted(function() {
            static::clearCache();
        });
    }

    public static function clearCache()
    {
        Cache::forget("banners_all");
    }
}
