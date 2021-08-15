<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Localization
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
        //dd( $request->route()->parameter('lang') );exit;
        $lang = $request->route()->parameter('lang');
        if( $lang ){
            App::setlocale( $lang );
        }
        return $next($request);
    }
}
