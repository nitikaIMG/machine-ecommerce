<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ProductCategory extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $table = 'product_categories';

    protected $translatedAttributes = ['title', 'short_description', 'description'];

    protected $fillable = ['parent_id', 'status', 'cover_image'];

    public function getTranslationRelationKey()
    {
        return 'product_category_id';
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    // shops that are serving this category
    public function shops()
    {
        return $this->belongsToMany(UserShop::class, 'seller_product_categories', 'product_category_id', 'user_shop_id');
    }

    public function getIsRootAttribute()
    {
        return empty($this->parent_id);
    }

    public function scopeParentCategory($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeNotParentCategory($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeByShop($query, int $shop_id)
    {
        return $query->whereHas('shops', function($query) use($shop_id) {
            $query->where('id', $shop_id);
        });
    }

    public function scopeByParentCategory($query, int $parent_id)
    {
        return $query->where('parent_id', $parent_id);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'seller_product_categories',
            'product_category_id',
            'user_id'
        );
    }

    public function sellers()
    {
        return $this->users();
    }

    public static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('status', '1');
        });
    }
}
