<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RingoSubProductList extends Model
{
    //
    public function product()
    {
        return $this->belongsTo(RingoProduct::class);
    }
}
