<?php

namespace App\Services\Settings\Facade;

use Illuminate\Support\Facades\Facade;

class Settings extends Facade {

    public static function getFacadeAccessor() 
    {
        return 'app_settings';
    }
}