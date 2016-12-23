<?php

namespace App\Http\Middleware;

use Closure;

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
                $appRoles = \Facebook::get('/' . env('FACEBOOK_APP_ID') . '/roles', $token)->getDecodedBody();
                foreach ($appRoles['data'] as $role) {
                    if ($role['user'] == \Auth::user()->provider_id && $role['role'] == 'administrators') {
                        \Session::put('isAdmin', true);
                        return $next($request);
                    }
                }
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
            return redirect('/')->with('error', 'You have to be admin to access');
        }
        else{
            return redirect('/')->with('error', 'You have to be logged in');
        }
    }
}
