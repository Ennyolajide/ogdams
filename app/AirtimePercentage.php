<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirtimePercentage extends Model
{
    //

    /**
     * Always json_decode settings so they are usable
     */
    public function getAirtimeToCashPhoneNumbersAttribute($value) {
        return json_decode($value,true);

        // you could always make sure you get an array returned also
        // return json_decode($value, true);
    }

    public function getAirtimeSwapPhoneNumbersAttribute($value) {
        return json_decode($value,true);
    }

    /**
     * Always json_encode the settings when saving to the database
     */
    public function setAirtimeToCashPhoneNumbersAttribute($value) {
        $this->attributes['airtime_to_cash_phone_numbers'] = json_encode($value);
    }

    public function setAirtimeSwapPhoneNumbersAttribute($value) {
        $this->attributes['airtime_swap_phone_numbers'] = json_encode($value);
    }

}
