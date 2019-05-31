<?php

namespace App\Http\Controllers;

use App\Airtime;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RingoAirtimeTopController extends RingoApiController
{

    protected $successResponse = 'Airtime Purchase successful';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Proces Airtime Topup
     */
    public function processAirtimeTopup()
    {
        if (Auth::user()->balance >= request()->amount) {

            $network = AirtimePercentage::find(request()->network)->network;

            $status = $this->topup();

            $status ? $this->notify($this->airtimeTopupNotification()) : false;

            return $status;
        }
    }

    /**
     *  Execute Airtime Top
     */
    public function topup()
    {
        $reference = $this->getUniqueReference();
        $response = $this->executeTopup($this->formatPhoneNumber(request()->phone), $reference);
        $status = $response ? $this->debitWallet(request()->amount) : false;
        $airtimeRecord = $this->storeTopup($status);
        $status ? $this->recordTransaction($airtimeRecord, $reference, $status, true) : false;

        return $status;
    }

    /**
     * Record Airtime Topup
     */
    public function storeTopup($status)
    {
        return Airtime::create([
            'user_id' => Auth::user()->id, 'network' => request()->network, 'amount' => request()->amount,
            'to_phone' => request()->phone, 'transaction_type' => 1, 'class' => 'App\Airtime', 'type' => 'Mobile Topup',
            'status' => $status
        ]);
    }

    /**
     * This Execute Airtime Topup Request
     */
    protected function executeTopup($msisdn, $reference)
    {
        $body = $this->generateTopupRequestBody($msisdn, request()->amount, $reference);

        return $body ? $this->ringo('topup/exec/' . $msisdn, 'post', $body) : false;
    }

    /**
     * Get Body content for Airtime Topup | To be used in AirtimeTopupRequest
     */
    protected function generateTopupRequestBody($msisdn, $amount, $reference)
    {
        $product = $this->ringo('topup/info/' . $msisdn)->products[0];
        $body = '{
            "product_id": "' . $product->product_id . '", "denomination" : "' . $amount . '",
            "send_sms" : false, "sms_text" : "", "customer_reference" : "' . $reference . '"
        }';

        return isset($product->product_id) ? $body : false;
    }
}


class AirtimeTopupController extends RingoAirtimeTopController
{

    public function index()
    {
        $networks = AirtimePercentage::all();

        return view('dashboard.airtime.topup', compact('networks'));
    }

    public function store()
    {

        $this->validate(request(), [
            'amount' => 'required|numeric',
            'network' => 'required|numeric',
            'phone' => 'required|min:11|max:13'
        ]);

        $status = $this->processAirtimeTopup();
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
