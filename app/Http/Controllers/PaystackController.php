<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackController extends PaymentController
{
    public $url;

    protected $failureResponse = 'Funding Complete';
    protected $successResponse = 'Wallet funding successful';


    /**
     * Auth Headers for Paystack
     */
    protected function paystackHeaders()
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
        $this->validate(request(), [
            'email' =>  'required|string',
            'amount'  => 'required|numeric|min:'.config("constants.fundings.paystack.min").'|max:'.config("constants.fundings.paystack.max"),
        ]);
        $charges = \config('constants.charges.paystack');
        $charge = $charges['chargePercentage'] / 100 * request()->amount;
        $charge = request()->amount < 2500 ? $charge : ($charge + $charges['addtionalCharge']);
        $totalTranxCharge = $charge < 2000 ? $charge : $charges['cappedCharge'];
        request()->merge([
            'amount' => ((request()->amount + $totalTranxCharge) * 100),
            'metadata' => json_encode(['amount' => request()->amount * 100]),
        ]);

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
        if (Auth::user()->role == 'admin') {
            $message = $status ? 'Wallet funded' : 'Transaction has been completed';
            return redirect()->route('admin.paystack.transactions')->withNotification($this->clientNotify($message, true));
        }
        return redirect(route('wallet.fund'))->withNotification($this->clientNotify($message, true));
    }

    /**
     * Get the list of all Banks
     */
    protected function bankList()
    {
        return json_decode($this->getPaystack('bank'));
    }


    public function queryPaysackTransaction()
    {
        $this->validate(request(), ['reference' => 'required|string|min:5|max:25']);
        $query = '?trxref=' . request()->reference . '&reference=' . request()->reference;

        return redirect(route('paystack.callback') . $query);
    }


    /**
     * Make a paystack call
     */
    protected function getPaystack($query)
    {
        $endPoint = \config('constants.url.paystack') . $query;
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $request = $client->get($endPoint, ['headers' => $this->paystackHeaders()]);
        $status = $request->getStatusCode() == '200' ? true : false;
        return $status ? $request->getBody()->getContents() : false;
    }

    /**
     *
     */
    protected function getTestBvn(){
        $endPoint = \config('constants.site.url').'/api/bvn';
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $request = $client->get($endPoint,['headers' => ['Content-Type' => 'application/json']]);
        $status = $request->getStatusCode() == '200' ? true : false;
        return $status ? $request->getBody()->getContents() : false;
    }
}
