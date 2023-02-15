<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogoutInactiveAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // at any point if the user is inactive;
        // log them out and redirect
        if( $user = $request->user() ) {

            if( $user->status !== 1 ) {

                auth('web')->logout();

                if( $user->role != \App\Vars\Roles::CUSTOMER ) {
                    return redirect('admin/login')
                        ->withInfo(__('Please login again to continue'));
                }

                return redirect('login')
                    ->withInfo(__('Please login again to continue'));
            }
        }

        return $next($request);
    }
}
