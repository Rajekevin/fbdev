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

class ParticipateController extends Controller
{
    public function index()
    {
        $userHelper = new UserHelper();
        $fbHelper = new FacebookHelper();
        if (!$userHelper->isConnected()) {
            return redirect()->away($fbHelper->getRedirectLoginUrl('participate'));
        }
        $permissions = $fbHelper->checkPermissions('participate');
        if (!$permissions || isset($permissions) && is_array($permissions) && sizeof($permissions) >= 1) {
            return redirect()->away($fbHelper->getReRequestPermissionLoginUrl($permissions));
        }

        return view('frontend.html.pages.participate');
    }
}
