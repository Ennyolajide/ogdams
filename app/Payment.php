<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $guarded = [];

    /*   protected $cast = [
        'object' => 'array'
    ]; */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->morphMany(Transaction::class, 'class');
    }
}
