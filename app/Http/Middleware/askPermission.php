<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\ParticipateHelper;
use App\Helpers\UserHelper;

class askPermission
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
        $userHelper = new UserHelper();
        if (!$userHelper->checkPermission()) {
            return redirect('/');
        }
        return $next($request);
    }
}
