<?php

namespace App\Http\Controllers\Control;

use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FundingsController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $transactions = Transaction::where('class_type', 'App\BankTransfer')->whereStatus(!NULL)->orderBy('id', 'desc')->paginate(20);

        return view('control.fundings', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {
        $status = request()->has('decline') || request()->has('completed') ? true : false;
        $transactionStatus = ['status' => request()->has('completed') ? 2 : 0];
        $status ? $trans->class->update($transactionStatus) : false;
        $status = $status ? $this->creditWallet($trans->class->amount) : false;
        $status ? $trans->update($transactionStatus) : false;
        $status ? $this->notify($this->creditNotification($trans->class->amount, $trans->method)) : false;
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
