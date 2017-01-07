<?php

/**
 * Class SocialController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Helpers\UserHelper;
use App\Helpers\FacebookHelper;
use App\Helpers\UserFacebookHelper;

class SocialController extends Controller
{
    /**
     * Prevent add picture to current contest
     *
     * @return bool
     */
    public function sharePicture()
    {
        /** @var \App\Helpers\UserHelper $userHelper */
        $userHelper = new UserHelper();
        /** @var \App\Helpers\FacebookHelper $fbHelper */
        $fbHelper = new FacebookHelper();
        /** @var \App\Helpers\UserFacebookHelper $fbUserHelper */
        $fbUserHelper = new UserFacebookHelper();
        if (!$userHelper->isConnected() || !$fbHelper->hasApplicationRegister()) {
           return json_encode(['error' => ['login' => $fbHelper->getRedirectLoginUrl('share')]]);
        }
        /** @var array $permissions */
        $permissions = $fbHelper->checkPermissions('share');
        if (!$permissions || isset($permissions) && is_array($permissions) && sizeof($permissions) >= 1) {
            return json_encode(['error' => ['login' => $fbHelper->getReRequestPermissionLoginUrl($permissions)]]);
        }
        if (!$fbUserHelper->sharePicture('1343434343')) {
            return json_encode(['error' => ['share' => true]]);
        }

        return json_encode(['error' => false]);
    }

}
