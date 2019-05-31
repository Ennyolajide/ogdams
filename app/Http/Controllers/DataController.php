<?php

namespace App\Http\Controllers;

use App\User;
use App\Data;
use App\DataPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMethods extends TransactionController
{
    /**
     * Record Airtime Topup
     */
    public function recordDataTopup($status)
    {
        return Airtime::create([
            'user_id' => Auth::user()->id, 'network' => request()->network, 'amount' => request()->amount,
            'to_phone' => request()->phone, 'transaction_type' => 1, 'class' => 'App\Airtime', 'type' => 'Mobile Topup',
            'status' => $status
        ]);
    }

    /**
     * This Execute Airtime Topup Request
     */
    protected function executeTopup($msisdn, $reference)
    {
        $body = $this->generateTopupRequestBody($msisdn, request()->amount, $reference);

        return $body ? $this->ringo('topup/exec/' . $msisdn, 'post', $body) : false;
    }
}

class DataController extends WalletController
{
    public function index()
    {
        return view('dashboard.data.prices');
    }

    public function create()
    {
        $dataPlans = DataPlan::all();
        $networks = DataPlan::orderBy('network_id', 'asc')->distinct()->get(['network', 'network_id']);

        return view('dashboard.data.buy', compact('dataPlans', 'networks'));
    }

    public function store()
    {
        $this->validate(request(), ['plan' => 'required|numeric|', 'phone' => 'required']);
        $dataPlan = DataPlan::find(request()->plan)->first();
        $response = $this->processDataPurchase($dataPlan);

        return back()->withResponse($response);
    }

    public function processDataPurchase($dataPlan)
    {
        if (Auth::user()->balance >= $dataPlan->amount) {
            $this->debitWallet($dataPlan->amount);
            Data::create([
                'user_id' => Auth::user()->id,
                'amount' => $dataPlan->amount,
                'network' => $dataPlan->network,
                'volume' => $dataPlan->volume,
                'phone' => request()->phone,
            ]);

            $response = 'Data Purchase successful';
        } else {
            $response = 'Insuffient balance, Pls fund your account';
        }
        //notification_phone_number
        return $response;
    }
}
