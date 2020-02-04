<?php

namespace App\Http\Controllers;

use App\BulkSmsConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_decode;

class SmsController extends TransactionController
{
    protected $amountPerUnit;
    protected $modalResponse;
    protected $failureResponse;
    protected $charactersPerPage = 160;
    protected $errorResponse = 'Unknown error , Pls try again later';

    /**
     * index
     */
    public function display()
    {
        $smsConfigs = BulkSmsConfig::all();

        return view('dashboard.sms.index', compact('smsConfigs'));
    }



    public function send()
    {
        //validation
        $this->validate(request(), [
            'route'  => 'required|json',
            'message' => 'required|string',
            'recepients' => 'required|string',
            'senderId' => 'required|string|min:3',
        ]);

        $routeId = json_decode(request()->route)->id;
        $smsConfigs = BulkSmsConfig::all();
        $smsConfig = $smsConfigs->find($routeId);
        $this->amountPerUnit = $smsConfigs->first()->amount_per_unit;
        $this->failureResponse = $smsConfig ? $this->errorResponse : false;
        $status = $smsConfig ? $this->processBulkSms($smsConfig) : false;
        $this->modalResponse = $status ? $this->setModalResponse($status) : false;

        return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
    }

    protected function processBulkSms($smsConfig)
    {
        //$smsPages = $this->countSmsPages(request()->message);
        $recipientList = trim(preg_replace('/\s+/', ' ', request()->recepients));
        $unitRequired = $this->unitRequired(($smsConfig->amount_per_unit / 100), $recipientList, request()->message);
        $isSufficientBalance = Auth::user()->balance >= ($unitRequired * $smsConfig->amount_per_unit / 100);
        $body = $this->setFormParamters(request()->senderId, request()->message, $recipientList, $smsConfig->routing);
        $response = $isSufficientBalance  ? $this->sendSms($body) : false;
        $response->units_used ? $this->debitWallet($response->units_used * $this->amountPerUnit / 100) : false;

        return $response;
    }

    /**
     * Get Account Balance
     */
    public function balance()
    {
        $client = new \GuzzleHttp\Client();
        $url = \config('constants.url.smartsmssolutions');
        $request = $client->get($url . '?checkbalance=1&token=' . \config('constants.smartsmssolutions.token'));
        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return $status ? $request->getBody()->getContents() : false;
    }

    /**
     * count the numbers of page of the content
     */
    protected function countSmsPages($content)
    {
        return ceil(strlen($content) / $this->charactersPerPage);
    }

    /**
     * Count the total numbers of recipient in of an array
     */
    protected function countRecipient(String $recipientList)
    {
        return count(explode(',', $recipientList));
    }

    /**
     * Get Price Required to Send Sms
     */
    protected function unitRequired($pricePerUnit, $recipientList, $content)
    {
        return ($this->countSmsPages($content) * $this->countRecipient($recipientList) * $pricePerUnit);
    }

    /**
     * compose form parameters for sending sms
     */
    protected function setFormParamters($senderId, $message, $to, $routing, $token = true)
    {
        return [
            'sender' => urlencode($senderId), 'to' => $to, 'message' => $message,
            'type' => '0', 'routing' => $routing, 'ref_id' => $this->getUniqueReference(),
            'token' => \config('constants.smartsmssolutions.token')
        ];
    }


    protected function sendSms($body)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $url = \config('constants.url.smartsmssolutions');
        $request = $client->post($url . '?json', ['form_params' => $body]);
        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return $status ? json_decode(str_replace('1002||', '', str_replace('1000||', '', $request->getBody()->getContents()))) : false;
    }

    protected function setModalResponse($status)
    {
        return $status;
    }
}
