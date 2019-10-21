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

    public function create()
    {
        $dataPlans = DataPlan::all();
        $networks = DataPlan::whereAvailable(true)->orderBy('network_id', 'asc')->get()->unique('network_id')->values()->all();

        return view('dashboard.data.buy', compact('dataPlans', 'networks'));
    }

    /**
     * Get all Available DataPlans
     */
    public function DataPlans()
    {
        return response()->json(
            DataPlan::all()->mapToGroups(function ($item, $key) {
                return [
                    $item['network'] => [
                        'plan' => $item['id'],
                        'volume' => $item['volume'],
                        'amount' => '₦' . $item['amount'],
                    ]
                ];
            }),
            200
        );
    }

    /**
     * Entry Point for Data Topup
     */
    public function store()
    {
        $this->validate(request(), ['plan' => 'required|numeric|', 'phone' => 'required']);

        $dataPlan = DataPlan::whereId(request()->plan)->first();

        $status = $dataPlan ? $this->processDataPurchase($dataPlan) : false;

        $message = $status ? $this->successResponse : $this->failureResponse;

        if (request()->wantsJson()) {
            return response()->json(['status' => $status, 'message' => $message], 200);
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Process Data Purchase
     */
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
        $reference = $this->getUniqueReference();
        $dataRecord = $this->storeTopup($dataPlan);
        $status = $dataRecord ? $this->debitWallet($dataPlan->amount) : false;
        $status ? $this->notifyAdmin($dataPlan, $reference) : false;
        $dataRecord ? $this->recordTransaction($dataRecord, $reference, false, true, false, false) : false;

        return $status;
    }

    /**
     * This notify the admin Either by mail or Sms or Both depending on the admin settings
     */
    protected function notifyAdmin($dataPlan, $reference)
    {
        $content =  str_replace('number', request()->phone, $dataPlan->notification_content);
        $dataPlan->phone_notification_status ? $this->notifyAdminViaSms($dataPlan->notification_phone, $content) : false;
        $dataPlan->email_notification_status ? $this->notifyAdminViaEmail('Data Order Notification', $content, $dataPlan->notification_email) : false;
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
