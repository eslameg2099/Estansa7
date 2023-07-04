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
            !(App::environment('local'))
            && (
                !$request->header('access-token')
                || $request->header('access-token') !== env('APP_API_TOKEN')
            )
        ) {
            return response()->json(['Message' => 'You do not access to this api.'], 403);
        }

        return $next($request);

    }
}
