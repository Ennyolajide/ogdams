<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;

class SmsController extends Controller
{
    //
    protected $charactersPerPage = 160;

    public function balance()
    {
        $client = new \GuzzleHttp\Client();
        $url = \config('constants.url.smartsmssolutions');
        $request = $client->get($url . '?checkbalance=1&token=' . env('SMARTSMSSOLUTION_TEST_TOKEN'));
        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return $status ? $request->getBody()->getContents() : false;
    }


    public function test()
    {
        $to = "07063637002,08090655966,08113722037";
        $message = "Voluptas perferendis excepturi. Laboriosam saepe porro explicabo vel esse sed. Esse et perferendis et. Assumenda dolor ea ab et corporis.";
        $body = $this->setFormParamters('quibusdam', $message, $to, 6, true);
        return $this->sendSms($body);
        //return $this->countSmsPages($content);
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
    protected function setFormParamters($senderId, $message, $to, $routing, $token = false)
    {
        return [
            'sender' => urlencode($senderId), 'to' => $to, 'message' => urlencode($message),
            'type' => '0', 'routing' => $routing, 'ref_id' => $this->getUniqueReference(),
            'token' => $token ? env('SMARTSMSSOLUTION_TOKEN') : env('SMARTSMSSOLUTION_TEST_TOKEN')
        ];
    }


    protected function sendSms($body)
    {

        $client = new \GuzzleHttp\Client();
        $url = \config('constants.url.smartsmssolutions');
        $request = $client->post($url . '?json', ['form_params' => $body]);
        //$status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return dd($request->getBody()->getContents());
    }
}


/* <?php

$message = 'Test message';
$senderid = 'Test Sender ID';
$to = '080*********';
$token = 'ACCESS_TOKEN';
$baseurl = 'https://smartsmssolutions.com/api/json.php?';

$sms_array = array(
    'sender' => $senderid,
    'to' => $to,
    'message' => $message,
    'type' => '0',
    'routing' => 3,
    'token' => $token
); */
