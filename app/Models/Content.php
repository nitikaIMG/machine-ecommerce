<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;

class Content extends Model
{
    use HasFactory, Translatable;
    protected $table = 'contents';
    protected $translatedAttributes = ['title','page_content'];
    protected $fillable =['title','slug','page_content'];
    public function getTranslationRelationKey()
    {
        return 'content_id';
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
