<?php

/**
 * Class User
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

use App\Helpers\UserHelper;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

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

    /**
     * Add associations between entity
     *
     * @ORM : User has many Pictures
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    /**
     * Save or update facebook user after callback redirect
     * @TODO : changer ce truc dégueulasse et vérification des entrées de tableau
     * @param $facebookUser
     * @return bool
     */
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
