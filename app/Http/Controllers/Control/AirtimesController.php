<?php

namespace App\Http\Controllers\Control;

use App\Transaction;
use App\AirtimePercentage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AirtimesController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $transactions = Transaction::where('class_type', 'App\Airtime')->whereStatus(!NULL)->orderBy('id', 'desc')->paginate(20);

        return view('control.airtimes', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {
        $status = request()->has('decline') || request()->has('completed') ? true : false;
        $transactionStatus = ['status' => request()->has('completed') ? 2 : 0];
        $status ? $trans->class->update($transactionStatus) : false;
        $status ? $trans->update($transactionStatus) : false;
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function settings()
    {
        $networks = AirtimePercentage::all();

        return view('control.airtime', compact('networks'));
    }

    public function editConfig(AirtimePercentage $network)
    {
        //validate request
        $this->validate(request(), [
            'percentage' => 'required|numeric', 'swapNumber1' => 'required|string', 'swapNumber2' => 'sometimes|nullable',
            'processTime' => 'required|numeric', 'transferCode' => 'required|string', 'topupPercentage' => 'required|numeric'
        ]);
        //save confif to DB
        $status = $network->update([
            'process_time' => request()->processTime,
            'transfer_code' => request()->transferCode,
            'airtime_swap_percentage' => request()->percentage,
            'airtime_to_cash_percentage' => request()->percentage,
            'airtime_topup_percentage' => request()->topupPercentage,
            'airtime_swap_percentage_status' => request()->has('swapStatus'),
            'airtime_to_cash_percentage_status' => request()->has('cashStatus'),
            'airtime_to_cash_phone_numbers' => json_encode([request()->swapNumber1, request()->swapNumber2])
        ]);

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function funding(Transaction $trans)
    {
        $creditAmout = $trans->class->amount * $trans->class->percentage / 100;
        $status = request()->has('decline') || request()->has('completed') ? true : false;
        $transactionStatus = ['status' => request()->has('completed') ? 2 : 0];
        $status ? $trans->class->update($transactionStatus) : false;
        $status = $status ? $this->creditWallet($creditAmout) : false;
        $status ? $trans->update($transactionStatus) : false;
        $status ? $this->notify($this->creditNotification($creditAmout, $trans->method)) : false;
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
