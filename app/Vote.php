<?php

/**
 * Class Vote
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /** @var array $fillable */
    protected $fillable = ['user_id', 'picture_id', 'contest_id'];

    /**
     * Add associations between entity
     *
     * @ORM : Vote belongs to Picture
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function picture()
    {
        return $this->belongsTo('App\Picture');
    }

    /**
     * Add associations between entity
     *
     * @ORM : Vote belongs to User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Add associations between entity
     *
     * @ORM : Vote belongs to Contest
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contest()
    {
        return $this->belongsTo('App\Contest');
    }

    /**
     * Save vote in table, before create we check if it already exist.
     * --> TRUE : Delete current like
     * --> FALSE : Add like
     * @TODO : finir la vérification avant la sauvegarde du like
     *
     * @param int $pictureId
     * @param int $userId
     * @param int $contestId
     * @return bool
     */
    public function saveVote($pictureId, $userId, $contestId)
    {
        if (!Vote::create([
            'user_id' => $userId,
            'picture_id' => $pictureId,
            'contest_id' => $contestId
        ])) {
            return false;
        }

        return true;
    }

    protected function checkIfVoteAlreadyExist()
    {
    }
}
