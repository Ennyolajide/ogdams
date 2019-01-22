<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use App\Bank;

class PaymentController extends Controller
{
    //
    public $url;

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {   request()->merge([ 'amount' => request()->amount * 100 ]);
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

    public function bankTransfer(){
        $banks = Bank::where('user_id',1)->get();
        return view('dashboard/wallet/bank',compact('banks'));
    }

    public function fundWithBankTransfer(){
        return request();
    }


}

