<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $path = $request->route()->getName();
            if( strpos($path, 'admin') === 0 ||
                strpos($path, 'seller') === 0 ) {
                return route('admin.login');
            }else if(strpos($path, 'customer') === 0){
                return route('home');
            }
            return url('/');
        }
    }
}
