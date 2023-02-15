<?php

namespace App\Models\Traits;

trait ScopeIsActive
{
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}