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
        if (!$userHelper->isConnected() || !$fbHelper->hasApplicationRegister()) {
           return json_encode(['error' => ['login' => $fbHelper->getRedirectLoginUrl('share')]]);
        }
        if (!$userHelper->sharePictureToUserWall('1343434343')) {
            return json_encode(['error' => ['share' => true]]);
        }

        return json_encode(['error' => false]);
    }

}
