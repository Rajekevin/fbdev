<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    public function pictures()
    {
        return $this->hasMany('App\Picture');
    }

    public function addPictureToCurrentContest($pictureId)
    {
        $contest = $this->_getCurrentContest();

    }

    protected function _getCurrentContest()
    {
        /** @var \App\Contest $contest */
        $contest = Contest::select('id')->where('short', 'Concours')->first();
        if (!$contest) {
            return false;
        }

        return $contest->id;
    }
}
