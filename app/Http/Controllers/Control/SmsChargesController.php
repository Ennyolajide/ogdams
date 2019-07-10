<?php

namespace App\Http\Controllers\Control;

use App\Charge;
use App\BulkSmsConfig;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SmsChargesController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show()
    {
        $charges = Charge::all();
        $smsConfigs = BulkSmsConfig::where('amount_per_unit', '>', 0)->get();

        return view('control.charges', compact('charges', 'smsConfigs'));
    }

    public function editSmsConfig(BulkSmsConfig $route)
    {
        //validate request
        $this->validate(request(), ['amount' => 'required|numeric|min:1|max:2']);
        $status = $route->update(['amount_per_unit' => request()->amount * 100]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function editChargesConfig(Charge $service)
    {
        //validate request
        $this->validate(request(), ['amount' => 'required|numeric|min:1']);
        $status = $service->update(['amount' => request()->amount]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
