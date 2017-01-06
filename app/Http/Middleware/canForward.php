<?php

namespace App\Http\Middleware;

use App\Helpers\FacebookHelper;
use App\Helpers\UserHelper;
use Closure;

class canForward
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
        /** @var \App\Helpers\FacebookHelper $fbHelper */
        $fbHelper = new FacebookHelper();
        /** @var \App\Helpers\UserHelper $userHelper */
        $userHelper = new UserHelper();
        if (!$userHelper->isConnected() || !$fbHelper->hasApplicationRegister()) {
            return redirect()->away($fbHelper->getRedirectLoginUrl('participate'));
        }
        /** @var array $permissions */
        $permissions = $fbHelper->checkPermissions('participate');
        if (!$permissions || isset($permissions) && is_array($permissions) && sizeof($permissions) >= 1) {
            return redirect()->away($fbHelper->getReRequestPermissionLoginUrl($permissions));
        }

        return $next($request);
    }
}
