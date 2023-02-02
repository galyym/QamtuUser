<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
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
        $request->headers->set('Accept', 'application/json');

        // Cpanel не пропускает authorization токен поэтому были предприняты такие меры
        if ($request->hasHeader("X-Auth")){
            $request->headers->set("authorization", "Bearer ".$request->headers->get("X-Auth"));
            $request->headers->remove("X-Auth");
        }
        return $next($request);
    }
}
