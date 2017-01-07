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
use Jenssegers\Date\Date;

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
     * Get user birthday
     *
     * @param $birthday
     * @return bool|Date
     */
    public function getUserBirthday($birthday)
    {
        if (!isset($birthday)) {
            return false;
        }

        return new Date($birthday);
    }

    /**
     *
     * @param $pictureId
     * @return bool
     */
    public function sharePictureToUserWall($pictureId)
    {
        return true;
    }
}