<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{

    public function handle($request, Closure $next, ...$guards)
    {
        // Cpanel не пропускает authorization токен поэтому были предприняты такие меры
        if ($request->hasHeader("X-Auth")){
            $request->headers->set("authorization", "Bearer ".$request->headers->get("X-Auth"));
            $request->server->set("REDIRECT_HTTP_AUTHORIZATION", "Bearer ".$request->headers->get("X-Auth"));
            $request->server->set("HTTP_AUTHORIZATION", "Bearer ".$request->headers->get("X-Auth"));
            $request->headers->remove("X-Auth");
        }
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }

        return null;
    }
}
