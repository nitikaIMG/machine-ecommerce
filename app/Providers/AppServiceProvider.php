<?php

namespace App\Providers;

use App\Services\Settings\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('app_settings', function() {
            return new Settings();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('email_or_phone', function ($attribute, $value, $parameters, $validator) {
            if( $validator->validateEmail($attribute, $value, []) ) {
                return true;
            }

            return $validator->validateDigitsBetween($attribute, $value, [8, 12]);
        });

        Validator::extend('lat_long', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $value) == 1;
        }, __('Invalid location value'));

        Collection::macro('flattenTree', function ($childrenField) {
            $result = collect();
        
             foreach ($this->items as $item) {
                $result->push($item);
        
                if ($item->$childrenField instanceof Collection && $item->$childrenField->isNotEmpty()) {
                    $result = $result->merge($item->$childrenField->flattenTree($childrenField));
                }
            }
        
            return $result;
        });

        Paginator::useBootstrap();
    }
}
