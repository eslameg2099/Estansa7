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
        if(request()->headers->get('referer') != 'https://estansa7.com/')
        {
            return response('stop', 404);
        } 
        
        return $next($request); 
    }
}
