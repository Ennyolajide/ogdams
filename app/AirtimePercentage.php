<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirtimePercentage extends Model
{
    //
    protected $guarded = [];

    protected $cast = [
        'airtime_to_cash_phone_numbers' => 'array'
    ];
}
