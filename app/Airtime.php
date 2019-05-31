<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    protected $guarded = [];

    //cast to array
    protected $casts = [
        'recepients'      => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->morphMany(Transaction::class, 'class');
    }
}
