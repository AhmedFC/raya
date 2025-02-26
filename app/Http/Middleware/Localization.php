<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->hasHeader("Accept-Language")) {
            \App::setLocale($request->header("Accept-Language"));
        }
        if(\Session::has('lang')) {
            \App::setLocale(\Session::get("lang"));
        }
        return $next($request);
    }
}
