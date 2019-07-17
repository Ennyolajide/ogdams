<?php

namespace App\Http\Controllers;

use App\Bitcoin;
use Illuminate\Http\Request;

class BitcoinController extends HomeController
{
    //

    public function show(Bitcoin $action)
    {

        return view('dashboard/coins/index', compact('action'));
    }
}
