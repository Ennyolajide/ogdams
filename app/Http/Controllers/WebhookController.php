<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_decode;

class WebhookController extends  PaystackController
{
    //
    public function paystackHook()
    {
        // only a post with paystack signature header gets our attention
        $postRequestMethod = strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
        $validRequestSignature = array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER);
        !$postRequestMethod || !$validRequestSignature ? exit() : false;


        // Retrieve the request's body
        $input = @file_get_contents("php://input");
        define('PAYSTACK_SECRET_KEY', config('constants.paystack.secretkey'));

        // validate event do all at once to avoid timing attack
        ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY)) ? exit() : false;


        http_response_code(200);

        // parse event (which is json string) as object
        // Do something - that will not take long - with $event
        $event = json_decode($input);


        $event->event === 'charge.success' ? '' : exit();

        $tranx = $this->verifyTranx($event->data->reference);

        isset($tranx['data']['status'])  ? '' : exit();

        $tranx['data']['status']  === 'success' ? '' : exit();

        $status = $this->fundUserWallet($tranx['data']);

        $status ? Log::info('Webhook Report :' . $input) : '';

        return response()->json([
            'status' => $status, 'message' => $status ? 'Success' : 'Failed'
        ], 200);


        exit();
    }

    protected function verifyTranx($reference)
    {
        $response = $this->getPaystack('transaction/verify/' . $reference);
        return $response ? json_decode($response, true) : $response;
    }
}
