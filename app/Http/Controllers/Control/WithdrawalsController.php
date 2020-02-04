<?php

namespace App\Http\Controllers\Control;

use App\Charge;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class WithdrawalsController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $transactions = Transaction::where('class_type', 'App\Withdrawal')->orderBy('id', 'desc')->paginate(20);

        return view('control.withdrawals', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {

        if (request()->has('completed')) {
            $transactionStatus = ['status' =>  2];
            $status = $trans->class->update($transactionStatus);
            $status ? $trans->update($transactionStatus) : false;
            $status ? $this->notifyUser($trans->user->id, $this->controlWithdrawalNotification($trans->amount)) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else if (request()->has('decline')) {
            $transactionStatus = ['status' =>  0];
            $status = $trans->class->update($transactionStatus);
            $charge = Charge::whereService('withdrawals')->first()->amount;
            $status ? $this->creditUserWallet($trans->user->id, ($trans->class->amount + $charge)) : false;
            $status ? $trans->update($transactionStatus) : false;
            $status ? $this->notifyUser($trans->user->id, $this->controlWithdrawalNotification($trans->amount)) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else {
            $status = false;
            $message = $this->errorResponse;
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
