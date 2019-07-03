<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends PaystackController
{
    //


    public function index()
    {
        $banks = $this->bankList()->data;
        $myBanks = Bank::where('user_id',Auth::user()->id)->get();
        //return $myBanks;

        return view('dashboard.profile.index',compact('banks','myBanks'));
    }


}
