<?php

namespace App\Http\Middleware;

use Closure;
use Facebook\Exceptions\FacebookSDKException;

class Administrator
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
        if(\Session::get('isAdmin'))
            return $next($request);

        elseif (\Auth::check()) {
            $token = env('FACEBOOK_APP_ID') . '|' . env('FACEBOOK_SECRET');
            try {
                $appRoles = \Facebook::get('/' . env('FACEBOOK_APP_ID') . '/roles?fields=user', $token)->getDecodedBody();
                foreach ($appRoles['data'] as $role) {
                    if ($role['user'] === \Auth::user()->provider_id) {
                        \Session::put('isAdmin', true);
                        return $next($request);
                    }
                }
            } catch (FacebookSDKException $e) {
                dd($e->getMessage());
            }
            return redirect('/')->with('error', 'You have to be admin to access');
        }
        else{
            return redirect('/')->with('error', 'You have to be logged in');
        }
    }
}
