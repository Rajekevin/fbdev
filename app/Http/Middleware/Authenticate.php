<?php

namespace App\Http\Middleware;

use Closure;
use Facebook\Facebook;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::check() && \Auth::user()->is_active) {
            // TODO : Check users scopes
            if (!checkScope()){
                return redirect('/')->with('error', 'You have to allow all the permissions to access this');
            }

            return $next($request);
        }

        return redirect('/')->with('error', 'You have to be logged in');
    }
}
