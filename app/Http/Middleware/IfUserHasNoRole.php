<?php

namespace App\Http\Middleware;

use Closure;

class IfUserHasNoRole
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

        if(count(auth()->user()->getRoleNames()) < 1) {

            return redirect('/select-role');

        }

        return $next($request);
    }
}
