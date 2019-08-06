<?php

namespace App\Http\Middleware;

use Closure;

class IsAuthor
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
        if (auth()->user() && (auth()->user()->isAdmin() || auth()->user()->isAuthor())) {
            return $next($request);
        }
        return redirect('/');
    }
}
