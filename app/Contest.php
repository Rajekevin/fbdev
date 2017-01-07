<?php

/**
 * Class Contest
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    /**
     * Add associations between entity
     *
     * @ORM : Contest has many Pictures
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    /**
     * Get current contest
     *
     * @return Contest|bool
     */
    public function getContest()
    {
        return $this->_loadCurrentContest();
    }

    /**
     * Load current contest
     * @TODO : Ajouter le bon filtre SQL
     *
     * @return Contest|bool
     */
    public function _loadCurrentContest()
    {
        /** @var \App\Contest $contest */
        $contest = Contest::select('id')->where('short', 'Concours')->first();
        if (!$contest) {
            return false;
        }

        return $contest;
    }
}
