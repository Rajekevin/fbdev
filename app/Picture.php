<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    public function contest()
    {
        return $this->belongsTo('App\Contest');
    }
}
