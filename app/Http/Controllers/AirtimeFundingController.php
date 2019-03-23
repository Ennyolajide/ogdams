<?php

namespace App\Http\Controllers;

use App\Airtime;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirtimeFundingController extends WalletController
{
    /* public function cash(){
        $percentages = AirtimePercentage::where('airtime_to_cash_percentage_status',true)->get();
        return view('dashboard.airtime.cash',compact('percentages'));
    } */

    public function store()
    {
        $this->validate(request(), [
            'phone' => 'required|min:11|max:11',
            'airtime_amount' => 'required|numeric|min:3|max:5'
        ]);
        $network = AirtimePercentage::find(request()->network);
        Airtime::create([
            'user_id' => Auth::user()->id,
            'percentage' => $network->airtime_to_cash_percentage,
            'amount' => request()->airtime_amount,
            'network' => $network->network,
            'from_phone' => request()->phone,
            'to_phone' => '08033353290',
            'transaction_type' => 5,
        ]);

        return redirect('dashboard/wallet/fund/airtime')
                        ->withTo('0903344556677')
                        ->withAmount(request()->amount)
                        ->withNetwork(request()->network)
                        ->withNetworkName($network->network);

    }

    public function show()
    {
        return session()->has('to') ?
            view('dashboard/wallet/airtime') : redirect(route('wallet.fund'));
    }
}
