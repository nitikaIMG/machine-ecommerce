<?php

namespace App\ModelFilters;

trait ProductFilter
{
    use BaseFilter;

    protected $filtersOnlyForAdmin = [];

    private function af_id($query, $id)
    {
        return $query->where('id', $id);
    }

    private function af_title($query, $title)
    {
        return $query->whereTranslation('title', $title);
    }

    private function af_category($query, $title)
    {
        return $query->whereHas('product_category', function($query) use($title) {
            return $query->whereTranslationLike('title', "%{$title}%");
        });
    }

    private function af__all($query, $value)
    {
        if( filter_var($value, FILTER_VALIDATE_INT) ) {
            return $this->af_id($query, $value);
        }

        return $query->whereTranslation('title', $value)
            ->orWhereHas('product_category', function($query) use($value) {
                return $query->whereTranslationLike('title', "%{$value}%");
            });
    }
}