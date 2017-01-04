<?php
/**
 * Class UserHelper
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Auth as Auth;

class UserHelper
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
    }

    /**
     * Get current user
     *
     * @return Auth|bool
     */
    public function getUser()
    {
        if(!Auth::check()) {
            return $this->getLoginFacebookRedirect();
        }

        return Auth::user();
    }

    public function isConnected()
    {
        return Auth::check() ? true : false;
    }

    public function getRedirectLoginUrl()
    {
        $fb = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
        $login_url = $fb->getLoginUrl(['email']);

        return $login_url;
    }

    public function checkPermission()
    {
        return false;
    }

    protected function getLoginFacebookRedirect()
    {
        $fb = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
        $login_url = $fb->getLoginUrl(['email']);
        return $login_url;
    }
}