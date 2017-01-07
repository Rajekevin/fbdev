<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Helpers\ContestHelper;

class Picture extends Model
{
    /** @var array $fillable */
    protected $fillable = ['link', 'title', 'description', 'location', 'author_id', 'contest_id'];

    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function contest()
    {
        return $this->belongsTo('App\Contest');
    }

    public function votes(){
        return $this->hasMany('App\Vote');
    }

    public function savePicture($pictureData)
    {
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        if (!Picture::create([
            'link' => $pictureData['link'],
            'title' => $pictureData['title'],
            'description' => $pictureData['description'],
            'location' => $pictureData['location'],
            'disabled' => false,
            'author_id' => Auth::user()->id,
            'contest_id' => $contestHelper->getCurrentContest(),
        ])) {
            return false;
        }

        return true;
    }
}
