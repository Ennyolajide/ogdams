<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;

class NotificationController extends HomeController
{
    protected function creditNotification($amount)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with '.$this->naira($amount);

        return $notification;
    }

    protected function withdrawalNotification($amount)
    {
        $notification['subject'] = 'Withdral Notification';
        $notification['content'] = 'You have initiated a withdral of '.$this->naira($amount);
        $notification['content'] .= ' charges of '.$this->naira($this->withdrawCharges).' applies.';

        return $notification;
    }

    protected function airtimeTopupNotification($amount)
    {
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with '.$this->naira($amount);

        return $notification;
    }

    public function sendSms()//$to, $content)
    {
        $to = '+2347063637002';
        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $message = $client->messages->create($to, [
            'from' => env('TWILIO_NUMBER'),
            'body' => 'hello word',
        ]);

        return $message;
    }
}
