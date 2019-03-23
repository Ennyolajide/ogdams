<?php

namespace App\Http\Controllers;

use App\PaymentGateway;
use App\AirtimePercentage;

class WalletController extends PaymentController
{
    public function index()
    {
        $gateways = PaymentGateway::where('status', true)->get();
        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status', true)->get();

        return view('dashboard.wallet.fund', compact('gateways', 'networks'));
    }
}
