<?php
/**
 * Class SessionHelper
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class FunnelHelper
{
    /** @var string $_SESSION_KEY_PARTICIPATION */
    private $_SESSION_KEY_PARTICIPATION = 'tmp_user_participation';

    /**
     * Init item in session for funnel process
     *
     * @return bool
     */
    public function initFunnelParticipation()
    {
        $this->deleteTmpUserParticipation();
        if ($this->_updateTmpParticipation([
            'photo' => null,
            'title' => null,
            'description' => null,
            'location' => null,
            'disabled' => null,
            'author' => null,
            'contest' => null,
        ])) {
            return true;
        }

        return false;
    }

    /**
     * @param $pictureUrl
     * @return bool|array
     */
    public function saveTmpPhoto($pictureUrl)
    {
        /** @var array $tmpParticipation */
        $tmpParticipation = $this->_getTmpParticipationData();
        if (!isset($tmpParticipation)) {
            return false;
        }
        /** Save picture in session */
        $tmpParticipation['photo'] = $pictureUrl;
        $this->_updateTmpParticipation($tmpParticipation);

        return $this->_getTmpParticipationData();
    }

    /**
     * Delete the current funnel participation from Session
     *
     * @return bool
     */
    public function deleteTmpUserParticipation()
    {
        return Session::forget($this->_SESSION_KEY_PARTICIPATION);
    }

    /**
     * Get array of the tmp participation data
     *
     * @return array
     */
    protected function _getTmpParticipationData()
    {
        return Session::get($this->_SESSION_KEY_PARTICIPATION);
    }

    /**
     * Update participation data in session
     *
     * @param array $tmpParticipation
     * @return bool
     */
    protected function _updateTmpParticipation($tmpParticipation)
    {
        if (!isset($tmpParticipation)) {
            return false;
        }

        return Session::put($this->_SESSION_KEY_PARTICIPATION, $tmpParticipation);
    }
}