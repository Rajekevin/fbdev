<?php

/**
 * Class ContestController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Helpers\ContestHelper;

class ContestController extends Controller
{
    /**
     * Get items ordered by like
     *
     * @return string
     */
    public function getPicturesByLike()
    {
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        /** @var array|bool $items */
        $items = $contestHelper->sortItemsByKey('like');
        if (!isset($items) || !$items) {
            return false;
        }
        return('Filtre par like');
    }

    /**
     * Get items ordered by newest
     *
     * @return string
     */
    public function getPicturesByNewest()
    {
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        /** @var array|bool $items */
        $items = $contestHelper->sortItemsByKey('newest');
        if (!isset($items) || !$items) {
            return false;
        }
        return('Filtre par nouveauté');
    }

    /**
     * Get items ordered by alphabetical
     *
     * @return string
     */
    public function getPicturesByAlphabetical()
    {
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        /** @var array|bool $items */
        $items = $contestHelper->sortItemsByKey('alphabetical');
        if (!isset($items) || !$items) {
            return false;
        }
        return('Filtre par alphabet');
    }
}
