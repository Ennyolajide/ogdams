<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bvn extends Model
{
    //

    protected $guarded = [];

    protected $cast = [
        'bvn_details' => 'array'
    ];

    protected function user(){
        return $this->belongsTo(User::class);
    }
}
