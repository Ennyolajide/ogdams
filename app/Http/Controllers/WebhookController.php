<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WebhookController extends Controller
{
    //
    public function paystack()
    {

        // only a post with paystack signature header gets our attention
        $postRequestMethod = strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
        $validRequestSignature = array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER);
        !$postRequestMethod || !$validRequestSignature ? exit() : false;


        // Retrieve the request's body
        $input = @file_get_contents("php://input");
        define('PAYSTACK_SECRET_KEY', 'SECRET_KEY');

        // validate event do all at once to avoid timing attack
        ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY)) ? exit() : false;


        http_response_code(200);

        // parse event (which is json string) as object
        // Do something - that will not take long - with $event
        $event = json_decode($input);

        // check for counterfiet ip
        //!in_array($event.,['52.31.139.75', '52.49.173.169', '52.214.14.220']) ? exit() : false;
        Log::info($event);

        // to be completed

        exit();
    }
}
