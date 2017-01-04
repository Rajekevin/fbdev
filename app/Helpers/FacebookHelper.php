<?php
/**
 * Class FacebookHelper
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FacebookHelper
{
    /**
     * @var null $facebook
     */
    protected $facebook;
    /**
     * @var null $user
     */
    protected $user;
    /**
     * @var array $defaultPermissions
     */
    protected $defaultPermissions = array('email', 'user_birthday');
    /**
     * @var array $participatePermissions
     */
    protected $participatePermissions = array('user_photos', 'publish_actions');

    /**
     * UserHelper constructor.
     */
    public function __construct()
    {
        $this->facebook = app(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk::class);
        $this->user = Auth::user();
    }

    /**
     * Get URL of an re-request permissions if they missed or refunded
     *
     * @param array $permissions
     * @return string
     */
    public function getReRequestPermissionLoginUrl($permissions)
    {
        return $this->facebook->getReRequestUrl($permissions);
    }

    /**
     * Get login redirect with permissions
     *
     * @param string $bindAction
     * @return string
     */
    public function getRedirectLoginUrl($bindAction)
    {
        /** @var array $permissions */
        $permissions = [];
        switch ($bindAction) {
            case 'participate' :
                $permissions = array_merge($permissions, $this->defaultPermissions, $this->participatePermissions);
                break;
            default:
                $permissions = array_merge($permissions, $this->defaultPermissions);
                break;
        }

        return $this->facebook->getLoginUrl($permissions);
    }

    /**
     * Check permissions of user and re-request if needed
     *
     * @param $action
     * @return array|bool
     */
    public function checkPermissions($action)
    {
        if (!isset($this->user)) {
           return false;
        }
        /** @var string $fbAccessToken */
        $fbAccessToken = Session::get('fb_user_access_token');
        if (!isset($fbAccessToken)) {
            return false;
        }
        /** @var array $reAskPermissions */
        $reAskPermissions = [];
        /** @var array $scopes */
        $scopes = $this->facebook->get('/me/permissions', $fbAccessToken)->getDecodedBody();
        /** @var array $finalPermissions */
        $finalPermissions = $this->defaultPermissions;
        switch ($action) {
            case 'participate' :
                $finalPermissions = array_merge($finalPermissions, $this->participatePermissions);
                break;
        }
        /** @var array $grantedPermissionsKey */
        $grantedPermissionsKey = $this->_getGrantedPermissionsKeyFromScopes($scopes, $finalPermissions);
        /** @var array $refundedPermission */
        foreach ($grantedPermissionsKey['refundedPermissions'] as $refundedPermission) {
            if (!isset($refundedPermission['permission'])) {
                continue;
            }
            $reAskPermissions[] = $refundedPermission['permission'];
        }
        /** @var array $reAskPermissions */
        $reAskPermissions = array_merge($reAskPermissions, array_diff($grantedPermissionsKey['updatedPermissions'], $grantedPermissionsKey['grantedPermissions']));
        if (isset($reAskPermissions) && is_array($reAskPermissions) && sizeof($reAskPermissions) < 1) {
            return true;
        }

        return $reAskPermissions;
    }

    /**
     * Merge current permissions and final permissions
     *
     * @param array $scopes
     * @param array $finalPermissions
     * @return array|bool
     */
    protected function _getGrantedPermissionsKeyFromScopes($scopes, $finalPermissions)
    {
        if (!isset($scopes['data'])) {
            return false;
        }
        /** @var array $scopes */
        $scopes = $scopes['data'];
        /** @var array $grantedPermissionsKey */
        $grantedPermissionsKey = [
            'refundedPermissions' => [],
            'updatedPermissions' => [],
            'grantedPermissions' => []
        ];
        /** @var array $scope */
        foreach ($scopes as $scope) {
            /** @var array $finalPermission */
            foreach ($finalPermissions as $finalPermission) {
                if ($scope['permission'] == $finalPermission && $scope['status'] == 'granted') {
                    $grantedPermissionsKey['grantedPermissions'][] = $finalPermission;
                    continue;
                }
                if (isset($scope['permission']) && isset($scope['status'])
                && $scope == $finalPermission && isset($scope['status']) == 'declined') {
                    $grantedPermissionsKey['refundedPermissions'][] = $finalPermission;
                }
                if (!in_array($finalPermission, $grantedPermissionsKey['updatedPermissions'])) {
                    $grantedPermissionsKey['updatedPermissions'][] = $finalPermission;
                }
            }
        }

        return $grantedPermissionsKey;
    }
}