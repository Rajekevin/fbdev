<?php

/**
 * Class Picture
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App;

use App\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\ContestHelper;

class Picture extends Model
{
    /** @var array $fillable */
    protected $fillable = ['link', 'title', 'description', 'location', 'author_id', 'contest_id'];

    /**
     * Add associations between entity
     *
     * @ORM : Picture belongs to one User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Add associations between entity
     *
     * @ORM : Picture belongs to one Contest
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contest()
    {
        return $this->belongsTo('App\Contest');
    }

    /**
     * Add associations between entity
     *
     * @ORM : Picture belongs to one Vote
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(){
        return $this->hasMany('App\Vote');
    }

    /**
     * Save picture in database
     *
     * @param array $pictureData
     * @return bool
     */
    public function savePicture($pictureData)
    {
        if (!isset($pictureData) || !is_array($pictureData)) {
            return false;
        }
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        /** @var \App\Helpers\UserHelper $userHelper */
        $userHelper = new UserHelper();
        if (!Picture::create([
            'link' => $pictureData['link'],
            'title' => $pictureData['title'],
            'description' => $pictureData['description'],
            'location' => $pictureData['location'],
            'disabled' => false,
            'author_id' => $userHelper->getId(),
            'contest_id' => $contestHelper->getCurrentContest(),
        ])) {
            return false;
        }

        return true;
    }
}
