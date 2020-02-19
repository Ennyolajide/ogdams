<?php

namespace App\Http\Controllers\Control;

use App\Bill;
use App\Setting;
use App\DataPlan;
use App\Transaction;
use App\RingoProduct;
use App\AirtimePercentage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class SettingsController extends ModController
{
    protected $errorResponse = 'Invalid Operation';
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function index()
    {
        $settings = Setting::all();
        $networks = AirtimePercentage::all();
        $bills = RingoProduct::where('product_list', true)->get();

        return view('control.settings', compact('settings', 'networks', 'bills'));
    }

    public function edit(Setting $setting){
        $this->validate(request(), [ 'status' => 'sometimes|string' ]);
        $status = $setting->update([ 'status' => request()->has('status')]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
