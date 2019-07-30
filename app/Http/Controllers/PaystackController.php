<?php

namespace App\Http\Controllers;

use Paystack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
        ];
    }

    /**
     * Redirect the User to Paystack Payment Page.
     *
     * @return Url
     */
    public function redirectToGateway()
    {
        request()->merge(['amount' => request()->amount * 100]);

        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information.
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        //execute fund user wallet method
        $status = $this->fundUserWallet($paymentDetails['data']);
        //send message to inbox about what just happen
        $status ? $this->notify($this->cardPaymentNotification($paymentDetails['data']['amount'] / 100)) : false;
        //set success / failure message for user
        $message = $status ? $this->successResponse : $this->failureResponse;
        //redirect back and show message
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
}
