<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPlan extends Model
{
    //
    protected $guarded = [];


    public function plans(){
        return $this->hasMany(DataPlan::class, 'network_id', 'network_id');
    }

}
