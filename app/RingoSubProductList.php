<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RingoSubProductList extends Model
{

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(RingoProduct::class, 'ringo_product_id', 'id');
    }
}
