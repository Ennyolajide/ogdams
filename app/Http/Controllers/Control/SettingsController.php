<?php

namespace App\Http\Controllers\Control;

use App\Bill;
use App\DataPlan;
use App\Transaction;
use App\RingoProduct;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\AirtimePercentage;

class SettingsController extends ModController
{

    public function index()
    {
        $bills = RingoProduct::where('product_list', true)->get();

        $networks = AirtimePercentage::all();

        return view('control.settings', compact('bills', 'networks'));
    }
}
