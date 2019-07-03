<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    protected $guarded = [];

    //cast to array
    protected $casts = [
        'recepients'      => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function transaction()
    {
        return $this->morphMany(Transaction::class, 'class');
    }

    public function networkName()
    {
        return $this->belongsTo(AirtimePercentage::class, 'network','id');
    }
}
