<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoinTransaction extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->morphMany(Transaction::class, 'class');
    }
}
