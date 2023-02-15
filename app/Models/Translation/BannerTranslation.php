<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title','short_description'];

    protected $table = 'banner_translations';

    public $timestamps = false;
}
