<?php

/**
 * Check user's scope
 * @return bool true if granted
 */
function checkScope()
{
    $isGranted = true;
    $permissions = getDefaultScope();
    $scopes = \Facebook::get('/me/permissions', \Session::get('fb_user_access_token'))->getDecodedBody();
    $scopes = $scopes['data'];

    foreach ($permissions as $permission) {
        foreach ($scopes as $scope) {
            if ($permission === $scope['permission'] && $scope['status'] !== 'granted') {
                $isGranted = false;
                break;
            }
        }
        if ($isGranted == false)
            break;
    }

    return $isGranted;
}

/**
 * @return array
 */
function getDefaultScope()
{
    return explode(",", env("FACEBOOK_SCOPE"));
}