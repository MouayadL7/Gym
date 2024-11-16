<?php

namespace App\Http\Middleware;

use Closure;

class SetUserType
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
        // Capture 'type' from the route parameters and set it in the request attributes
        if ($type = $request->route('type')) {
            $request->attributes->set('type', $type);
        }

        return $next($request);
    }
}

