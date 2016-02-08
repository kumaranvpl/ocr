<?php

namespace App\Http\Middleware;

use Closure;

class checkAdminCookie
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
        if(!isset($_COOKIE["admin"])  || (base64_decode($_COOKIE["admin"])!="yes"))
        {
            return redirect('/login');
        }
        return $next($request);
    }
}
