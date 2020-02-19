<?php

namespace App\Http\Controllers\Control;

use App\Transaction;
use App\AirtimePercentage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AirtimesController extends ModController
{
    protected $errorResponse = 'Invalid Operation';
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $transactions = Transaction::where('class_type', 'App\Airtime')->orderBy('id', 'desc')->paginate(20);

        return view('control.airtimes', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {
        $creditAmout = $trans->class->amount * $trans->class->percentage / 100;
        if (request()->has('completed')) {
            $transactionStatus = ['status' =>  2];
            $trans->class->update($transactionStatus);
            $trans->update(['status' =>  2, 'balance_after' => ($trans->user->balance + $creditAmout)]);
            $status = $this->creditUserWallet($trans->user_id, $creditAmout);
            $status ? $trans->update($transactionStatus) : false;
            $status ? $this->notify($this->creditNotification($creditAmout, $trans->method)) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else if (request()->has('decline')) {
            $transactionStatus = ['status' =>  0];
            $status = $trans->update($transactionStatus);
            $status ? $status = $this->failureResponse : false;
            $message = $status ? $this->successResponse : false;
        } else {
            $status = false;
            $message = $this->errorResponse;
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function settings()
    {
        $networks = AirtimePercentage::whereAddon(false)->get();

        return view('control.airtime', compact('networks'));
    }

    public function editConfig(AirtimePercentage $network)
    {
        //dd(request()->all());
        //validate request
        $this->validate(request(), [
            'hostedSimServerToken' => 'sometimes|nullable', 'percentage' => 'required|numeric', 'swapNumber1' => 'required|string',
            'swapNumber2' => 'sometimes|nullable', 'processTime' => 'required|numeric', 'transferCode' => 'sometimes|string',
            'topupPercentage' => 'required|numeric', 'airtimeTopupUssdCode' => 'sometimes|nullable', 'hostedSimApiToken' => 'sometimes|nullable',
        ]);
        //save confif to DB
        $status = $network->update([
            'process_time' => request()->processTime,
            'transfer_code' => request()->transferCode,
            'airtime_swap_percentage' => request()->percentage,
            'airtime_to_cash_percentage' => request()->percentage,
            'hosted_sim_api_token' =>request()->hostedSimApiToken,
            'airtime_topup_percentage' => request()->topupPercentage,
            'airtime_topup_ussd_code' => request()->airtimeTopupUssdCode,
            'hosted_sim_server_token' => request()->hostedSimServerToken,
            'airtime_swap_percentage_status' => request()->has('swapStatus'),
            'airtime_to_cash_percentage_status' => request()->has('cashStatus'),
            'airtime_to_cash_phone_numbers' => json_encode([request()->swapNumber1, request()->swapNumber2])
        ]);

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function configSwitch(AirtimePercentage $network)
    {
        //validate request
        $this->validate(request(), [
            'airtimeTopupStatus' => 'sometimes|string',
            'airtimeTopupSimRoute' => 'sometimes|string',
        ]);
        //save confif to DB
        $status = $network->update([
            'airtime_topup_status' => request()->has('airtimeTopupStatus'),
            'airtime_topup_sim_route' => request()->has('airtimeTopupSimRoute'),
        ]);

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function funding(Transaction $trans)
    {
        $creditAmout = $trans->class->amount * $trans->class->percentage / 100;
        if (request()->has('completed')) {
            $transactionStatus = ['status' =>  2];
            $trans->class->update($transactionStatus);
            $status = $this->creditUserWallet($trans->user->id, $creditAmout);
            $status ? $trans->update($transactionStatus) : false;
            $status ? $this->notify($this->creditNotification($creditAmout, $trans->method)) : false;
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
}
