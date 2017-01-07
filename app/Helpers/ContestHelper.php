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
use App\Picture;
use App\Vote;

use Illuminate\Support\Facades\DB;

class ContestHelper
{
    /** @var \App\Contest $contest */
    protected $contest;

    /**
     * ContestHelper constructor.
     */
    public function __construct()
    {
        $this->contest = new Contest();
    }

    /**
     * Get current contest
     *
     * @return int
     */
    public function getCurrentContest()
    {
        /** @var \App\Contest $contest */
        $contest = $this->contest->getContest();

        return $contest->id;
    }

    /**
     * @return array|bool
     */
    public function getCurrentContestData()
    {
        /** @var array $contestData */
        $contestData = [];
        /** @var int $contestId */
        $contestId = $this->getCurrentContest();
        /** @var array $pictureCollection */
        $pictureCollection = Picture::with('votes')->where('contest_id', $contestId)->get();
        /** @var array $picture */
        foreach ($pictureCollection as $picture) {
            if (!isset($picture['id']) || !isset($picture['link']) || !isset($picture['title'])) {
                continue;
            }
            $contestData[] = [
                'id'        => $picture['id'],
                'picture'   => $picture['link'],
                'title'     => $picture['title'],
                'nbVotes'   => count($picture->Votes)
            ];
        }

        return $contestData;
    }

    /**
     * Add photo to contest
     *
     * @param string|null $pictureId
     * @return bool
     */
    public function addPhotoToCurrentContest($pictureId)
    {
        $pictureId = "156454";
        if (!isset($pictureId) || !$this->contest->addPictureToCurrentContest($pictureId)) {
            return false;
        }

        return true;
    }
}