<?php
/**
 * Class ContestHelper
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Helpers;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as Facebook;

class ContestHelper
{
    public static function renderContestObjectData($contestId)
    {
        return ['test' => 'test'];
    }

    public function sharePictureToFacebookWall($picture)
    {
        $userHelper = new UserHelper();
        $user = $userHelper->getUser();
        $fb = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
        $login_url = $fb->getLoginUrl(['email']);

        // TODO : Ajout du share
        return $login_url;
    }
}