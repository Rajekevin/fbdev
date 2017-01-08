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
     * Get current user
     *
     * @return bool
     */
    public function isConnected()
    {
        return Auth::check() ? true : false;
    }

    /**
     * Get current user
     *
     * @return bool
     */
    public function getId()
    {
        /** @var object $user */
        $user = $this->_getUser();
        if (!$user) {
            return false;
        }

        return $user->id;
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
     * Check if user have already vote in current picture
     *
     * @param $votes
     * @return bool
     */
    public function checkIfUserHaveAlreadyVote($votes)
    {
        if (!isset($votes)) {
            return false;
        }
        /** @var int $userId */
        $userId = $this->getId();
        foreach ($votes as $vote) {
            if ($userId !== $vote->user_id) {
                continue;
            }
            return true;
        }

        return false;
    }

    /**
     * Get current user
     *
     * @return object
     */
    protected function _getUser()
    {
        return Auth::user();
    }
}