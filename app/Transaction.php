<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->morphTo();
    }

    public function Status()
    {
        return $this->hasOne(Status::class);
    }
}
