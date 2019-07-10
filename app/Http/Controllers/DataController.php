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
        $this->validate(request(), [
            'plan' => 'required|numeric|',
            'phone' => 'required'
        ]);

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
        $status ? $this->notifyAdminViaSms($this->adminDataNotification($dataPlan), $dataPlan->notification_phone) : false;
        $dataRecord ? $this->recordTransaction($dataRecord, $this->getUniqueReference(), false, true, false, false) : false;

        return $status;
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
