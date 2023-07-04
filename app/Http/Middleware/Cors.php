<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     
        if (
           
               
               $request->header('access-token') != 1562
            
        ) {
            return response()->json(['Message' => 'You do not access to this api.'], 403);
        }

        return $next($request);

    }
}
