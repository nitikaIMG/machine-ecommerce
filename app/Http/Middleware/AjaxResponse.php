<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AjaxResponse
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
        $response = $next($request);

        if( $request->expectsJson() ) {

            if( $response instanceof RedirectResponse ) {

                $error = $response->getSession()->pull('error');

                if( ! empty($error) ) {
                    
                    return response()->json([
                        'error' => $error
                    ]);
                }
                
                return response()->json([
                    'redirect' => $response->getTargetUrl()
                ]);
            }
        }

        return $response;
    }
}
