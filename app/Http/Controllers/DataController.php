<?php

namespace App\Http\Controllers;

use App\User;
use App\Data;
use App\DataPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends TransactionController
{
    protected $successResponse = 'Data Topup successful';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    public function index()
    {
        return view('dashboard.data.prices');
    }

    public function create()
    {
        $dataPlans = DataPlan::all();
        $networks = DataPlan::orderBy('network_id', 'asc')->distinct()->get(['network', 'network_id']);

        return view('dashboard.data.buy', compact('dataPlans', 'networks'));
    }

    public function store()
    {
        //validate request
        $this->validate(request(), ['plan' => 'required|numeric|', 'phone' => 'required']);

        $dataPlan = DataPlan::find(request()->plan)->first();

        $status = $dataPlan ? $this->processDataPurchase($dataPlan) : false;

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function processDataPurchase($dataPlan)
    {
        if (Auth::user()->balance >= $dataPlan->amount) {

            $status = $this->topup($dataPlan);

            $status ? $this->notify($this->dataTopupNotification($dataPlan)) : false;

            return $status;
        }
    }

    /**
     * This Execute Airtime Topup Request
     */
    protected function topup($dataPlan)
    {
        $dataRecord = $this->storeTopup($dataPlan);
        $status = $dataRecord ? $this->debitWallet($dataPlan->amount) : false;
        $status ? $this->notifyAdmin($dataPlan) : false;
        $dataRecord ? $this->recordTransaction($dataRecord, $this->getUniqueReference(), false, true, false, false) : false;

        return $status;
    }

    /**
     * This notify the admin Either by mail or Sms or Both depending on the admin settings
     */
    protected function notifyAdmin($dataPlan)
    {
        $subject = 'Data Order Notification';
        $toEmail = $dataPlan->notification_email;
        $toPhone = $dataPlan->notification_phone;
        $content = $this->adminDataOrderNotification($dataPlan);
        $dataPlan->phone_notification_status ? $this->notifyAdminViaSms($toPhone, $content) : false;
        $dataPlan->email_notification_status ? $this->notifyAdminViaEmail($subject, $content, $toEmail) : false;
    }

    /**
     * Record Data Topup
     */
    protected function storeTopup($dataPlan)
    {
        return Data::create([
            'user_id' => Auth::user()->id, 'network' => $dataPlan->network, 'amount' => $dataPlan->amount,
            'phone' => request()->phone, 'volume' => $dataPlan->volume, 'class' => 'App\Data', 'type' => 'Data Topup'
        ]);
    }
}
