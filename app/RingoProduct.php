<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RingoProduct extends Model
{
    //


    public function productList()
    {
        return $this->hasMany(RingoSubProductList::class);
    }
}
