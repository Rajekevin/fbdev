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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;

class UserHelper
{
    /**
     * @var null $facebook
     */
    protected $facebook;

    /**
     * UserHelper constructor.
     */
    public function __construct()
    {
        $this->facebook = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
    }

    /**
     * Get current user
     *
     * @return bool
     */
    public function isConnected()
    {
        return Auth::check() ? true : false;
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function allowedFacebookCallback()
    {
        $fb = $this->facebook;
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
        if (!isset($token) || !$token) {
            $helper = $fb->getRedirectLoginHelper();
            if (!$helper->getError()) {
                abort(403, 'Unauthorized action.');
            }
            return redirect('/');
        }
        if (!$token->isLongLived()) {
            $oauth_client = $fb->getOAuth2Client();
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                return redirect('/');
            }
        }
        $fb->setDefaultAccessToken($token);
        Session::put('fb_user_access_token', (string) $token);
        try {
            $response = $fb->get('/me?fields=id,name,email');
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
        $facebook_user = $response->getGraphUser()->asArray();
        if (!User::createOrUpdateGraphNode($facebook_user)) {
            return redirect('/');
        }

        return true;
    }
}