<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function picture()
    {
        return $this->belongsTo('App\Picture');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
