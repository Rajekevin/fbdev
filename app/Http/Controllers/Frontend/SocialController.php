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

use App\Helpers\ContestHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    /**
     * Prevent add picture to current contest
     *
     * @return bool
     */
    public function sharePicture()
    {
        $contestHelper = new ContestHelper();
        $userHelper = new UserHelper();

        if (!$userHelper->isConnected()) {
           return $userHelper->getRedirectLoginUrl();
        }

        if (!$contestHelper->sharePictureToFacebookWall('1343434343')) {
           return json_encode(['login' => false]);
        }

        return json_encode(['login' => true]);
    }

}
