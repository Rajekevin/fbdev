<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')
            ->scopes([
                'email',
                'user_birthday',
            ])
            ->redirect();
    }

    public function callback()
    {
        return ;
    }
}
