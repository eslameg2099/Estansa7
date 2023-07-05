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
        $response = $next( $request );
        $response->header( 'Access-Control-Allow-Origin', 'estansa7.com' );
        $response->header( 'Access-Control-Allow-Headers', 'Origin, Content-Type' );
    
        return $response;
    }
}
