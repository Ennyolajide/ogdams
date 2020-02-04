<?php

namespace App\Http\Controllers\Control;

use Paystack;
use Carbon\Carbon;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FundingsController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $transactions = Transaction::where('class_type', 'App\BankTransfer')->whereNotNull('status')->orderBy('id', 'desc')->paginate(20);

        return view('control.fundings', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {
        if (request()->has('completed')) {
            $transactionStatus = ['status' =>  2];
            $user = $trans->class->update($transactionStatus) ? $trans->user : false;
            $referralBonus = $user->first_time_funding && $user->referrer ? $this->addReferrerBonus($user) : 0;
            $status = $this->creditUserWallet($user->id, ($trans->class->amount - $referralBonus));
            $status ? $trans->update(['status' =>  2, 'balance_after' => ($user->balance + $trans->class->amount  - $referralBonus)]) : false;
            $status ? $this->notifyUser($user->id, $this->creditNotification($trans->class->amount, $trans->method)) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else if (request()->has('decline')) {
            $transactionStatus = ['status' =>  0];
            $status = $trans->class->update($transactionStatus);
            $status ? $trans->update($transactionStatus) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else {
            $status = false;
            $message = $this->errorResponse;
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function paystackTransactions()
    {
        $transactions = collect(Paystack::getAllTransactions())
            ->where('status', 'success')
            ->where('createdAt', '>=', Carbon::now()->subDay(1));

        return view('control.paystackTransactions', compact('transactions'));
    }
}
