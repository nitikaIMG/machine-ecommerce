<?php

namespace App\Repositories;

use App\Models\ProductCategory;

class CategoryRepository
{
    public function all()
    {
        return cache()->remember('product_categories_all', 60*60, function() {
            return ProductCategory::all();
        });
    }

    public function all_parent()
    {
        return cache()->remember('product_categories_parent_all', 60*60, function() {
            return ProductCategory::parentCategory()->get();
        });
    }

    public function find(int $id)
    {
        return cache()->remember("product_category.{$id}", 60*60, function() use($id) {
            return $this->all()->find($id);
        });
    }
}