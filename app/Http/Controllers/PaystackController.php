<?php

namespace App\Http\Controllers;

use Paystack;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaystackController extends PaymentController
{
    public $url;

    protected $successResponse = 'Wallet funding successful';
    protected $failureResponse = 'Payment failed';

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
}
