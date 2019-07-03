<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $guarded = [];

    protected $cast = [
        'details' => 'array'
    ];
}
