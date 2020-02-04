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

        $transactions = Transaction::where('class_type', 'App\Data')->orderBy('id', 'desc')->paginate(20);

        return view('control.datas', compact('transactions'));
    }

    public function edit(Transaction $trans)
    {
        if (request()->has('completed')) {
            $transactionStatus = ['status' =>  2];
            $status = $trans->class->update($transactionStatus);
            $status ? $trans->update($transactionStatus) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else if (request()->has('decline')) {
            $transactionStatus = ['status' =>  0];
            $status = $trans->class->update($transactionStatus);
            $status ? $trans->update($transactionStatus) : false;
            $status ? $this->creditUserWallet($trans->user->id, $trans->class->amount) : false;
            $status ? $this->notifyUser($trans->user->id, $this->dataPurchaseDeclineNotification($trans)) : false;
            $message = $status ? $this->successResponse : $this->failureResponse;
        } else {
            $status = false;
            $message = $this->errorResponse;
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }


    public function settings($network)
    {
        $network = DataPlan::where('network_id', $network)->first();
        $plans = $network->plans;

        return view('control.data', compact('plans', 'network'));
    }

    public function editDataPlan(Dataplan $network)
    {
        $status = $network->update([
            'volume' => request()->volume,
            'amount' => request()->amount,
            'notification_content' => request()->notification
        ]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function deleteDataPlan(Dataplan $plan)
    {
        $status = $plan->delete();
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function newDataPlan(Dataplan $network)
    {
        //validate request
        $this->validate(request(), [
            'amount' => 'required|numeric',
            'volume' => 'required|string',
            'notification' => 'required|string'
        ]);
        $status = Dataplan::create([
            'volume' => request()->volume,
            'amount' => request()->amount,
            'network' => $network->network,
            'network_id' => $network->network_id,
            'notification_content' => request()->notification,
            'notification_phone' => $network->notification_phone,
        ]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function editDataPlanNotification(Dataplan $network)
    {
        //validate request
        $this->validate(request(), [
            'availabilityStatus' => 'sometimes|string',
            'email' => 'sometimes|email', 'emailNotificationStatus' => 'sometimes|string',
            'phone' => 'sometimes|string', 'phoneNotificationStatus' => 'sometimes|string',
        ]);
        // get and instance of the data plan
        $dataPlan = DataPlan::where('network_id', $network->network_id);
        $planIds = $dataPlan->pluck('id');

        //update the instance of the dataplan
        $status = Dataplan::whereIn('id', $planIds)->update([
            'available' => request()->has('availabilityStatus'),
            'phone_notification_status' => request()->has('phoneNotificationStatus'),
            'email_notification_status' => request()->has('emailNotificationStatus'),
            'notification_phone' => request()->phone ?? $dataPlan->first()->notification_phone,
            'notification_email' => request()->email ?? $dataPlan->first()->notification_email,
        ]);

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
