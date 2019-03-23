<?php

namespace App\Http\Controllers;

use App\User;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends walletController
{
    public $withdrawCharges = 100;

    public function index()
    {
        $charges = $this->withdrawCharges;
        $banks = User::where('id', Auth::user()->id)->first()->banks;

        if (!$banks->count()) {
            $response = 'Pls Add at least one Bank to your Profile';

            return redirect(route('messages.inbox'))->with('response', $response);
        }

        return view('dashboard/wallet/withdraw', compact('banks', 'charges'));
    }

    public function store()
    {
        $response = 'Amount is greater than withdrawable amount';
        //$this->validate(request(),['bank_id' => 'required|numeric','amount' => 'required|numeric|min:3|max:6']);
        if (Auth::user()->balance >= request()->amount) {
            $amount = request()->amount;
            Withdrawal::create([
                'user_id' => Auth::user()->id,
                'amount' => $amount - $this->withdrawCharges,
                'bank_id' => request()->bank_id,
            ]);
            $this->debitWallet($amount, $this->withdrawalNotification($amount));
            $response = 'Withdraw successful Pls wait while it is been processed';
        }

        return back()->with('response', $response);
    }
}
