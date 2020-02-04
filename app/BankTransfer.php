<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankTransfer extends Model
{
    protected $guarded = [];

    protected $cast = [
        'details' => 'array'
    ];

    public function bank()
    {
        return $this->hasOne('App\Bank', 'id', 'bank_id')->withTrashed();
    }

    public function transaction()
    {
        return $this->morphMany(Transaction::class, 'class');
    }
}
