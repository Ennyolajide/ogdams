<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //


    public function data(){
        return $this->belongsTo(Data::class, 'id', 'transaction_id');
    }

    public function airtime(){
        return $this->belongsTo(Data::class, 'id', 'transaction_id');
    }

    public function voucher(){
        return $this->belongsTo(Data::class, 'id', 'transaction_id');
    }
}
