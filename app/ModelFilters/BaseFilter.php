<?php

namespace App\ModelFilters;

trait BaseFilter
{
    public function scopeWithFilters($query, $items = [])
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if( isset($items['_col_key']) && isset($items['_col_value']) ) {
            $items[$items['_col_key']] = $items['_col_value'];
            unset($items['_col_key'], $items['_col_value']);
        }

        foreach( $items as $key => $value ) {
            if(empty($value) && $value != '0') continue;

            if( isset($this->filtersOnlyForAdmin) && in_array($key, $this->filtersOnlyForAdmin) ) {
                if( !$user || !$user->isAdmin() ) continue;
            }
            
            if( method_exists($this, 'af_'.$key) ) {
                
                call_user_func_array(
                    [$this, 'af_'.$key],
                    [$query, $value]
                );
            }
        }
    }
}