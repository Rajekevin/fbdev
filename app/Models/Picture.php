<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function contest()
    {
        return $this->belongsTo('App\Models\Contest');
    }

    public function votes(){
        return $this->hasMany('App\Models\Vote');
    }
}
