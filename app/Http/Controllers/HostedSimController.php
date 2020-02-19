<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostedSimController extends TransactionController
{
    public function hostedSimRequest($ussd, $simServerToken, $apiToken = NULL, $type = 'USSD'){
        $client = new \GuzzleHttp\Client($this->requestOption());
        $formparams = $this->formParams($ussd,$simServerToken,$apiToken,$type);
        $request = $client->post(config('constants.hostedSims.url'), $formparams);
        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return $status ? json_decode($request->getBody()->getContents()) : false;
    }

    protected function formParams($ussd, $simServerToken, $apiToken, $type){
        return [
            'form_params' => [
                'ussd'=> $ussd, 'type' => $type, 'servercode' => $simServerToken,
                'token' => config('constants.hostedSims.apiToken') ?? $apiToken,
            ]
        ];
    }

    protected function requestOption(){
        return ['debug' => false, 'http_errors' => false, 'timeout' => 50, 'connect_timeout' => 50];
    }

}
