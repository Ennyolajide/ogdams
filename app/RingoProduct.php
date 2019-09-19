<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RingoProduct extends Model
{
    //

    protected $hidden = ['status', 'created_at', 'updated_at'];


    public function productList()
    {
        return $this->hasMany(RingoSubProductList::class);
    }
}
