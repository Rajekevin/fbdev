<?php
/**
 * Class ContestHelper
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Helpers;

use App\Contest;
use Illuminate\Support\Facades\Session;

class ContestHelper
{
    /**
     * Add photo to contest
     *
     * @param string|null $pictureId
     * @return bool
     */
    public function addPhotoToCurrentContest($pictureId)
    {
        $pictureId = "156454";
        /** @var \App\Contest $contest */
        $contest = new Contest();
        if (!isset($pictureId) || !$contest->addPictureToCurrentContest($pictureId)) {
            return false;
        }

        return true;
    }
}