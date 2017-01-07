<?php

/**
 * Class RateController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Helpers\ContestHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\UserHelper;
use App\Helpers\FacebookHelper;

class RateController extends Controller
{
    /**
     * Prevent add picture to current contest
     *
     * @param Request $request
     * @return bool|string
     */
    public function addLike(Request $request)
    {
        /** @var int $pictureId */
        $pictureId = $request->input('id');
        if (!isset($pictureId)) {
            return json_encode(['error' => ['like' => true]]);
        }
        /** @var \App\Helpers\UserHelper $userHelper */
        $userHelper = new UserHelper();
        /** @var \App\Helpers\FacebookHelper $fbHelper */
        $fbHelper = new FacebookHelper();
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        if (!$userHelper->isConnected() || !$fbHelper->hasApplicationRegister()) {
            return json_encode(['error' => ['login' => $fbHelper->getRedirectLoginUrl('like')]]);
        }
        if (!$contestHelper->addVoteToPicture($pictureId)) {
            return json_encode(['error' => ['like' => true]]);
        }

        return json_encode(['error' => false]);
    }

}
