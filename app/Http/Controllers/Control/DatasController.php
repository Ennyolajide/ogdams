<?php

namespace App\Http\Controllers\Control;

use App\DataPlan;
use App\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Data;

class DatasController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {

        $transactions = Transaction::where('class_type', 'App\Data')->whereStatus(1)->orderBy('id', 'desc')->paginate(20);

        return view('control.datas', compact('transactions'));
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

    public function settings(DataPlan $network)
    {
        $plans = $network->plans;

        return view('control.data', compact('plans', 'network'));
    }

    public function editDataPlan(Dataplan $network)
    {
        //validate request
        $this->validate(request(), [
            'amount' => 'required|numeric', 'volume' => 'required|string'
        ]);
        $status = $network->update(['volume' => request()->volume, 'amount' => request()->amount]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function newDataPlan(Dataplan $network)
    {
        //validate request
        $this->validate(request(), ['amount' => 'required|numeric', 'volume' => 'required|string']);
        $status = Dataplan::create([
            'volume' => request()->volume,
            'amount' => request()->amount,
            'network' => $network->network,
            'network_id' => $network->network_id,
            'notification_phone' => $network->notification_phone,
        ]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function editPhone(Dataplan $network)
    {
        //validate request
        $this->validate(request(), ['phone' => 'required|string']);

        $status = DataPlan::where('network_id', $network->network_id)->update(['notification_phone' => request()->phone]);

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
