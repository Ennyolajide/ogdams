<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;

class NotificationController extends HomeController
{
    protected function creditNotification($amount)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with ' . $this->naira($amount);

        return $notification;
    }

    protected function withdrawalNotification($amount)
    {
        $notification['subject'] = 'Withdral Notification';
        $notification['content'] = 'You have initiated a withdral of ' . $this->naira($amount);
        $notification['content'] .= ' charges of ' . $this->naira($this->withdrawalCharges) . ' applies.';

        return $notification;
    }

    protected function cardPaymentNotification($amount)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with ' . $this->naira($amount);
        $notification['content'] .= ' using Card Payment ';

        return $notification;
    }

    protected function voucherWalletFundingNotification($voucher)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with ' . $this->naira($voucher->value);
        $notification['content'] .= ' using Voucher pin ( ' . $voucher->voucher . ')';

        return $notification;
    }

    protected function airtimeTopupNotification()
    {
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ';
        $notification['content'] .= $this->naira(request()->amount) . ' for airtime topup to ' . request()->phone;

        return $notification;
    }

    /**
     * notification for airtimeSwap
     */
    protected function airtimeSwapNotification($network, $airtimeSwapNumbers)
    {
        $swapedAmount = $network->airtime_swap_percentage / 100 * request()->amount;

        $content = 'To complete Airtime Swap from ' . request()->swapFromPhone . '(' . $network->network . ') to ';
        $content .= request()->swapToPhone . '(' . request()->swapToNetwork . ') Kindly transfer ' . $this->naira(request()->amount);
        $content .= ' to any of these ' . $network->network . ' numbers ' . $airtimeSwapNumbers . ' to receive ';
        $content .= $this->naira(floor($swapedAmount)) . ' Dail ' . $network->transfer_code . ' to complete your transfer';

        return ['subject' => 'AirtimeSwap Notification', 'content' => $content];
    }

    protected function coinPurchaseNotification($amount, $coinName)
    {
        $wallet = ' wallet : ' . request()->wallet;
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ' . $this->naira($amount);
        $notification['content'] .= ' for ' . $coinName . ' to ' . $coinName . $wallet;

        return $notification;
    }



    public function sendSms($to, $content) //$to, $content)
    {
        $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $message = $client->messages->create($to, [
            'from' => env('TWILIO_NUMBER'),
            'body' => $content,
        ]);

        return $message;
    }

    public function clientNotify($message, $status = false)
    {
        return (object)[
            'message' => $message,
            'status' => $status ? $status : false,
        ];
    }
}
