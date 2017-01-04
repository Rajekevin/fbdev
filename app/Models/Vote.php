<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function picture()
    {
        return $this->belongsTo('App\Models\Picture');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
