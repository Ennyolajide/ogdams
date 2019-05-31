<?php

namespace App\Http\Controllers;

use App\AirtimePercentage;
use Illuminate\Http\Request;

class AirtimeToCashController extends Controller
{
    //
    public function index()
    {
        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status', true)->get();

        return view('dashboard.airtime.cash', compact('networks'));
    }
}
