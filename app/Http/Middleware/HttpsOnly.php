<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->isSecure() && (config('app.env') === 'production' || config('app.force.https'))) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
