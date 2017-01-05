<?php

namespace App;

use App\Helpers\UserHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // not supported
    }

    public function getRememberTokenName()
    {
        return null; // not supported
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute) {
            parent::setAttribute($key, $value);
        }
    }

    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public static function createOrUpdateGraphNode($facebookUser)
    {
        $userHelper = new UserHelper();
        $user = User::where('provider_id', $facebookUser['id'])->first();
        if ($user) {
            $user->email = $facebookUser['email'];
            $user->firstname = $facebookUser['name'];
            $user->birthday = $userHelper->getUserBirthday($facebookUser['birthday']);
            $user->lastname = $facebookUser['last_name'];
            $user->is_active = $facebookUser['verified'];
            $user->save();
        } else {
            $user = User::create([
                'provider_id' => $facebookUser['id'],
                'firstname' => $facebookUser['name'],
                'lastname' => $facebookUser['last_name'],
                'birthday' => $userHelper->getUserBirthday($facebookUser['birthday']),
                'email' => $facebookUser['email'],
                'is_active' => $facebookUser['verified'],
            ]);
        }

        Auth::login($user);
        return true;
    }
}
