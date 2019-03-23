<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    //
    protected $guarded = [];

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
