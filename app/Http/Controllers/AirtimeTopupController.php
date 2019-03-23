<?php

namespace App\Http\Controllers;

use App\Airtime;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirtimeTopupController extends WalletController
{
    protected $successResponse = 'Airtime Purchase successful';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    public function index()
    {
        $networks = AirtimePercentage::all();

        return view('dashboard.airtime.topup', compact('networks'));
    }

    public function store()
    {
        $this->validate(request(), [
            'amount' => 'required|numeric|',
            'network' => 'required|numeric',
            'phone' => 'required|min:11|max:11',
        ]);
        $response = $this->process() ? $this->successResponse : $this->failureResponse;

        return back()->with('response', $response);
    }

    public function process()
    {
        if (Auth::user()->balance >= request()->amount) {
            $amount = request()->amount;
            $network = AirtimePercentage::find(request()->network)->network;
            Airtime::create([
                'user_id' => Auth::user()->id,
                'network' => $network,
                'amount' => $amount,
                'to_phone' => request()->phone,
                'transaction_type' => 3,
            ]);
            $notification = $this->creditNotification($amount);
            $notification['content'] .= ' for airtime topup to '.request()->phone;
            $this->debitWallet($amount, $notification);

            return true;
        }
    }
}
