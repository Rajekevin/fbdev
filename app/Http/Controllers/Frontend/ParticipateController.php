<?php

/**
 * Class ParticipateController
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

class ParticipateController extends Controller
{
    public function index()
    {
        /** @var \App\Helpers\UserHelper $userHelper */
        $userHelper = new UserHelper();
        /** @var \App\Helpers\FacebookHelper $fbHelper */
        $fbHelper = new FacebookHelper();
        /** @var \App\Helpers\$userFbHelper $userFbHelper */
        $userFbHelper = new UserFacebookHelper();
        if (!$userHelper->isConnected() || !$fbHelper->hasApplicationRegister()) {
            return redirect()->away($fbHelper->getRedirectLoginUrl('participate'));
        }
        /** @var array $permissions */
        $permissions = $fbHelper->checkPermissions('participate');
        if (!$permissions || isset($permissions) && is_array($permissions) && sizeof($permissions) >= 1) {
            return redirect()->away($fbHelper->getReRequestPermissionLoginUrl($permissions));
        }
        /** @var array $albums */
        $albums = $userFbHelper->getAlbums();

        return view('frontend.html.pages.participate', ['albums' => $albums]);
    }
}
