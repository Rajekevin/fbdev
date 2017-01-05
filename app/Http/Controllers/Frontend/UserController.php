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
use App\Helpers\FacebookHelper;

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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function facebookCallback()
    {
        /** @var \App\Helpers\FacebookHelper $fbHelper */
        $fbHelper = new FacebookHelper();
        if (!$fbHelper->callback()) {
            return redirect('/participate');
        }

        return redirect('/')->with('message', 'Successfully logged in with Facebook');
    }
}
