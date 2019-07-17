<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitcoin extends Model
{
    //

    public function getRouteKeyName()
    {
        return 'action';
    }
}
