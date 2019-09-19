<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Faker\Generator as Faker;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Mail;

class NotificationController extends DashboardController
{
    protected function creditNotification($amount, $method)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with ' . $this->naira($amount) . ' using ' . $method;

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

    protected function dataTopupNotification($dataPlan)
    {
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ';
        $notification['content'] .= $this->naira($dataPlan->amount) . ' for data topup to ' . request()->phone;

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

    protected function tvTopupNotification($details, $uniqueReference, $responseObject)
    {
        $responseObject = $responseObject->original;
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ';
        $notification['content'] .= $this->naira($details['amount']) . ' for ' . $details['type'];
        $notification['content'] .= ' Topup to ' . request()->owner . ' ' . $details['product'] . ' decoder .... Reference : ' . $uniqueReference;
        $notification['content'] .= isset($responseObject['pin_based']) ? '<br/><br/><pre>' . $responseObject['pins'] . '</pre>' : '';

        return $notification;
    }

    protected function electricityTopupNotification($details, $uniqueReference)
    {
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ';
        $notification['content'] .= $this->naira($details['amount']) . ' for ' . $details['type'];
        $notification['content'] .= ' Topup to ' . request()->owner . ' ' . $details['product'] . ' Meter .... Reference : ' . $uniqueReference;

        return $notification;
    }

    protected function internetTopupNotification($details, $uniqueReference, $responseObject)
    {
        $responseObject = $responseObject->original;
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ' . $this->naira($details['amount']) . ' for ' . $details['type'];
        $notification['content'] .= ' Topup ' . request()->has('owner') ? 'to ' . request()->owner . ' ' . $details['product'] : '';
        $notification['content'] .= ' .... Reference : ' . $uniqueReference;
        $notification['content'] .= isset($responseObject['pin_based']) ? '<br/><br/><pre>' . $responseObject['pins'] . '</pre>' : '';

        return $notification;
    }

    protected function miscTopupNotification($details, $uniqueReference, $responseObject)
    {
        $responseObject = $responseObject->original;
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ' . $this->naira($details['amount']);
        $notification['content'] .= ' for ' . $details['product'] . '(' . $details['type'] . ') .... Reference : ' . $uniqueReference;
        $notification['content'] .= isset($responseObject['pin_based']) ? '<br/><br/><pre>' . $responseObject['pins'] . '</pre>' : '';

        return $notification;
    }


    protected function addBankDetailsNotification($charges)
    {
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ';
        $notification['content'] .= $this->naira($charges) . ' for adding a new bank account to your profile';

        return $notification;
    }

    /**
     * Notify Client of something that happend
     */
    public function clientNotify($message, $status = false)
    {
        return (object) [
            'message' => $message,
            'status' => $status ? $status : false,
        ];
    }


    /* Control Notification */

    protected function controlWithdrawalNotification($amount)
    {
        $notification['subject'] = 'Withdral Notification';
        $notification['content'] = 'Your withdral request of ' . $this->naira($amount) . ' has been ';
        $notification['content'] .= request()->has('completed') ? 'proccessed' : 'canceled';

        return $notification;
    }


    /**
     * Notify Admin Via Email
     */
    protected function notifyAdminViaEmail($subject, $content, $toEmail)
    {
        Mail::to($toEmail)->send(new OrderNotification($subject, $content));
    }

    /**
     * Notify Admin Via Sms
     */
    protected function notifyAdminViaSms($to, $message)
    {
        $client = new \GuzzleHttp\Client();
        $client->post(\config('constants.url.smartsmssolutions') . '?json', [
            'form_params' => [
                'sender' => env('SITE_SMS_SENDER_ID'), 'message' => $message, 'to' => $to,
                'type' => '0', 'routing' => 3, 'token' => env('SMARTSMSSOLUTION_TOKEN')
            ]
        ]);
    }
}
