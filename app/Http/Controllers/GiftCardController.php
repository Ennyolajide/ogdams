<?php

namespace App\Http\Controllers;

use App\Bitcoin;
use Illuminate\Http\Request;

class GiftCardController extends HomeController
{
    //

    public function show()
    {
        $action = Bitcoin::first();

        return view('dashboard/giftcard/index', compact('action'));
    }
}
