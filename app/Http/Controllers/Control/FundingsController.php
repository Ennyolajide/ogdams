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
        if (request()->has('completed')) {
            $transactionStatus = ['status' =>  2];
            $trans->class->update($transactionStatus);
            $status = $this->creditUserWallet($trans->user->id, $trans->class->amount);
            $status ? $trans->update($transactionStatus) : false;
            $status ? $this->notify($this->creditNotification($trans->class->amount, $trans->method)) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else if (request()->has('decline')) {
            $transactionStatus = ['status' =>  0];
            $trans->class->update($transactionStatus);
            $status ? $trans->update($transactionStatus) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else {
            $status = false;
            $message = $this->errorResponse;
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
