<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'short_description', 'description'];

    protected $table = 'product_category_translations';

    public $timestamps = false;
}
