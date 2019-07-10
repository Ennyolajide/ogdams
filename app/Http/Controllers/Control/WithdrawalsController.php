<?php

namespace App\Http\Controllers\Control;

use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class WithdrawalsController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $transactions = Transaction::where('class_type', 'App\Withdrawal')->whereStatus(1)->orderBy('id', 'desc')->paginate(20);
        return view('control.withdrawals', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {
        $status = request()->has('decline') || request()->has('completed') ? true : false;
        $transactionStatus = ['status' => request()->has('completed') ? 2 : 0];
        $status ? $trans->class->update($transactionStatus) : false;
        $status ? $trans->update($transactionStatus) : false;
        //$status ? $this->notify($this->controlWithdrawalNotification($trans->amount)) : false;
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
