<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class SocialAuthController extends Controller
{

    public function callback()
    {
        // Obtain an access token.
        try {
            $token = \Facebook::getAccessTokenFromRedirect();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (!$token) {
            // Get the redirect helper
            $helper = \Facebook::getRedirectLoginHelper();

            if (!$helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        // The token may expire soon
        if (!$token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = \Facebook::getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        \Facebook::setDefaultAccessToken($token);

        // Save for later
        \Session::put('fb_user_access_token', (string)$token);

        // Get info on the user
        try {
            $response = \Facebook::get('/me?fields=id,first_name,last_name,email,birthday');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $facebook_user = $response->getGraphUser();

        $user = User::whereProviderId($facebook_user['id'])->first();

        if (!$user) {
            $user = User::create([
                'provider_id' => $facebook_user['id'],
                'firstname' => $facebook_user['first_name'],
                'lastname' => $facebook_user['last_name'],
                'email' => $facebook_user['email'],
                'birthday' => $facebook_user['birthday'],
            ]);

            $user->save();
        }

        \Auth::login($user);

        return redirect('/')->with('message', 'Successfully logged in');
    }

    public function logout()
    {
        if (\Auth::check()){
            \Auth::logout();
            \Session::clear();
        }
        return redirect('/');
    }
}
