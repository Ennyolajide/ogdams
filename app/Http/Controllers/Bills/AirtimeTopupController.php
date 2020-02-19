<?php

namespace App\Http\Controllers\Bills;

use App\Airtime;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AirtimeTopupController extends RingoController
{

    protected $successResponse = 'Airtime Purchase successful';
    protected $apiErrorResponse = 'Airtime Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Index Route
     */
    public function index()
    {
        $networks = AirtimePercentage::whereAddon(false)->get();
        return view('dashboard.airtime.topup', compact('networks'));
    }

    /**
     * Fetch Available Netoworks
     */
    public function networks()
    {
        $networks = AirtimePercentage::whereAddon(false)->get(['network', 'id']);

        return response()->json($networks, 200);
    }

    /**
     * Airtime Topup
     */
    public function store()
    {
        $this->validate(request(), [
            'amount' => 'required|numeric',
            'network' => 'required|numeric',
            'phone' => 'required|string|min:11|max:13'
        ]);

        $status = $this->processAirtimeTopup();
        $message = $status ? $this->successResponse : $this->failureResponse;

        if (request()->wantsJson()) {
            return response()->json([
                'status' => $status,
                'message' => $message
            ], 200);
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Airtime Topup
     */
    public function processAirtimeTopup()
    {
        if (Auth::user()->balance >= request()->amount) {

            $network = AirtimePercentage::find(request()->network);

            $status = $network && $network->airtime_topup_status ? $this->topup($network) : false;

            $status ? $this->notify($this->airtimeTopupNotification()) : false;

            return $status;
        }
    }

    /**
     *  Execute Airtime Top
     */
    public function topup($network)
    {
        $reference = $this->getUniqueReference(); // generate a unique reference number
        $discount = $network->airtime_topup_percentage / 100; // get the percentage discount
        $response = $network->airtime_topup_sim_route ?
            $this->HostedSimTopup($network)
            : $this->executeTopup($this->formatPhoneNumber(request()->phone), $reference);
        $this->failureResponse = $response ? $this->failureResponse : $this->apiErrorResponse;
        $status = $response ? $this->debitWallet(request()->amount * $discount) : false;
        $airtimeRecord = $this->storeTopup($status);
        $this->recordTransaction($airtimeRecord, $reference, $status, $status, false, true);

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
            'status' => $status ? 2 : 0
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

    /**
     *
     */
    protected function hostedSimTopup($network){
        $ussd =  $network->airtime_topup_ussd_code;
        $ussd =  str_replace('number', request()->phone,str_replace('amount', request()->amount, $ussd));
        return $this->hostedSimRequest($ussd, $network->hosted_sim_server_token, $network->airtime_topup_ussd_code, 'USSD');
    }
}
