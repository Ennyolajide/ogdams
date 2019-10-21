<?php

namespace App\Http\Controllers;

use Paystack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaystackController extends PaymentController
{
    public $url;

    protected $failureResponse = 'Payment failed';
    protected $successResponse = 'Wallet funding successful';


    /**
     * Auth Headers for Paystack
     */
    protected function headers()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . \config('constants.paystack.secretkey'),
        ];
    }

    /**
     * Redirect the User to Paystack Payment Page.
     *
     * @return Url
     */
    public function redirectToGateway()
    {
        //$originalAmount = request()->amount * 100;
        $charges = \config('constants.charges.paystack');
        $additionalCharge = request()->amount < 2500 ? 0 : $charges['addtionalCharge'];
        $totalTranxCharge = (($charges['chargePercentage'] / 100 * request()->amount) + $additionalCharge);
        $cappedTranxCharge = $totalTranxCharge < 2000 ? $totalTranxCharge : $charges['cappedCharge'];
        request()->merge(['amount' => ((request()->amount + $cappedTranxCharge) * 100)]);

        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information.
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $status = $this->fundUserWallet($paymentDetails['data']);
        $message = $status ? $this->successResponse : $this->failureResponse;
        //redirect back and show message
        if (Auth::user()->role == 'admin') {
            $message = $status ? 'Wallet funded' : 'Transaction has been completed';
            return redirect()->route('admin.paystack.transactions')->withNotification($this->clientNotify($message, $status));
        }
        return redirect(route('wallet.fund'))->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Get the list of all Banks
     */
    protected function bankList()
    {
        return json_decode($this->getPaystack('bank'));
    }

    /**
     * Make a paystack call
     */
    protected function getPaystack($query)
    {
        $endPoint = \config('constants.url.paystack') . $query;
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $request = $client->get($endPoint, ['headers' => $this->headers()]);
        $status = $request->getStatusCode() == '200' ? true : false;
        return $status ? $request->getBody()->getContents() : false;
    }

    public function queryPaysackTransaction()
    {
        $this->validate(request(), ['reference' => 'required|string|min:5|max:25']);
        $query = '?trxref=' . request()->reference . '&reference=' . request()->reference;

        return redirect(route('paystack.callback') . $query);
    }
}
