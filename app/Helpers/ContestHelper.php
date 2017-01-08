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

class ContestHelper
{

    /**
     * @var array FILTER_ATTRIBUTES_KEY
     */
    const FILTER_ATTRIBUTES_KEY = ['like', 'newest', 'alphabetical'];
    /** @var \App\Vote $vote */
    protected $vote;
    /** @var \App\Contest $contest */
    protected $contest;
    /** @var \App\Picture $picture */
    protected $picture;
    /** @var \App\Helpers\UserHelper $userHelper */
    protected $userHelper;

    /**
     * ContestHelper constructor.
     */
    public function __construct()
    {
        $this->vote = new Vote();
        $this->contest = new Contest();
        $this->picture = new Picture();
        $this->userHelper = new UserHelper();
    }

    /**
     * Get current contest
     *
     * @return int|bool
     */
    public function getCurrentContest()
    {
        /** @var \App\Contest $contest */
        $contest = $this->contest->getContest();
        if (!$contest) {
            return false;
        }

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
        $pictureCollection = $this->picture->with('votes')->where('contest_id', $contestId)->get();
        /** @var array $picture */
        foreach ($pictureCollection as $picture) {
            if (!isset($picture['id']) || !isset($picture['link']) || !isset($picture['title'])) {
                continue;
            }
            $contestData[] = [
                'id'                => $picture['id'],
                'picture'           => $picture['link'],
                'title'             => $picture['title'],
                'nbVotes'           => count($picture->Votes),
                'hasAlreadyVote'    => $this->userHelper->checkIfUserHaveAlreadyVote($picture->Votes)
            ];
        }

        return $contestData;
    }

    /**
     * Add photo to contest
     *
     * @param Request $request
     * @return bool
     */
    public function addPhotoToContest($request)
    {
        if (!isset($request)) {
            return false;
        }
        if (!$this->picture->savePicture([
            'link'          => $request->input('link'),
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'location'      => $request->input('location'),
            'author'        => $request->input('author'),
        ])) {
            return false;
        }

        return true;
    }

    /**
     * Add new vote on contest
     *
     * @param int $pictureId
     * @return bool
     */
    public function addVoteToPicture($pictureId)
    {
        /** @var int $contestId */
        $contestId = $this->getCurrentContest();
        /** @var int|bool $userId */
        $userId = $this->userHelper->getId();
        if (!isset($contestId) || !isset($userId) || !isset($pictureId)
        || !$contestId || !$userId || !$pictureId) {
            return false;
        }
        if (!$this->vote->saveVote($pictureId, $userId, $contestId)) {
            return false;
        }

        return true;
    }

    // @TODO : Finir les filtres

    /**
     * @param string $key
     * @return array|bool
    */
    public function sortItemsByKey($key)
    {
        if (!isset($key)) {
            return false;
        }
        if (!in_array($key, self::FILTER_ATTRIBUTES_KEY)) {
            return false;
        }
        /** @var string $bindFunction */
        $bindFunction = '_loadItemsBy' . ucfirst($key);
        if (!method_exists($this, $bindFunction)) {
            return false;
        }
        /** @var array $items */
        $items = $this->$bindFunction();

        return $items;
    }

    /**
     * Return an array of items filtered by newest
     *
     * @return array|bool
     */
    protected function _loadItemsByNewest()
    {
        dd('test 1');
    }

    /**
     * Return an array of items filtered by alphabetical
     *
     * @return array|bool
     */
    protected function _loadItemsByAlphabetical()
    {
        dd('test 2');
    }

    /**
     * Return an array of items filtered by like
     *
     * @return array|bool
     */
    protected function _loadItemsByLike()
    {
        dd('test 3');
    }
}