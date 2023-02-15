<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository
{
    public function all()
    {
        return cache()->rememberForever('banners_all', function() {
            return Banner::active()->get();
        });
    }
}