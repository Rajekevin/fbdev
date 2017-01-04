<?php

/**
 * Class UserController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;

class UserController extends Controller
{
    /**
     * Add like to current picture contest
     *
     * @return string
     */
    public function login ()
    {
        return 'lol';
    }

    public function facebookCallback()
    {
        $userHelper = new UserHelper();
        if (!$userHelper->allowedFacebookCallback()) {
            return redirect('/participate');
        }

        return redirect('/')->with('message', 'Successfully logged in with Facebook');
    }
}
