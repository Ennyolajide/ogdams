<?php

namespace App\Http\Controllers;

use Twilio\Rest\Client;
use Faker\Generator as Faker;
use App\Mail\OrderNotification;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\Mail;
use function GuzzleHttp\json_decode;

class NotificationController extends  DashboardController
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

    protected function dataPurchaseDeclineNotification($trans)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with ';
        $notification['content'] .= $this->naira($trans->class->amount) . ' for data topup( ' . $trans->class->phone . ' ) ';
        $notification['content'] .= 'reversal as a result of technical timeout <br/>';
        $notification['content'] .= 'We apologize for any inconvenience this may have caused';

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

        return $notification;
    }

    protected function electricityTopupNotification($details, $uniqueReference, $responseObject, $charges)
    {
        $responseObject = $responseObject->original;
        $notification['subject'] = 'Debit Notification';
        $notification['content'] = 'Your wallet has been debited with ';
        $notification['content'] .= $this->naira($details['amount'] + $charges) . ' for ';
        $notification['content'] .= request()->has('owner') ? request()->owner : '' . $details['product'] . ' Meter Topup.<br/>';
        $notification['content'] .= 'Reference : ' . $uniqueReference . '<br/>';
        $notification['content'] .= $responseObject->pin_based ? '<br/><pre>' . $responseObject->pin_code . '</pre><br/>' : '';
        $notification['content'] .= $details['product'] . ' message : ' . $responseObject->pin_option1;

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
        try {
            $amount = $this->naira($details['amount']);
            $responseObject = $responseObject->original;
            $notification['subject'] = 'Debit Notification';
            $notification['content'] = 'Your wallet has been debited with ' . $amount;
            $notification['content'] .= ' for ' . $details['product'] . '(' . $details['type'] . ')';
            $notification['content'] .= 'Transaction Reference : <span class="text-primary">' . $uniqueReference.'</span><br/><br/>';
            $notification['content'] .= $responseObject->pin_based ? '<pre class="text-success">'.json_encode($responseObject->pins).'</pre>' : '';
        } catch (\Exception $e) {
            Log::info('Cound not Format Misc Topup Notification');
        }
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
        try {
            Mail::to($toEmail)->send(new OrderNotification($subject, $content));
        } catch (\Exception $e) {
            Log::info('Cound not send Admin Notification Email');
        }
    }

    /**
     * Notify Admin Via Sms
     */
    protected function notifyAdminViaSms($to, $message)
    {
        try {
            $client = new \GuzzleHttp\Client(['http_errors' => false]);
            $client->post(\config('constants.url.smartsmssolutions') . '?json', [
                'form_params' => [
                    'sender' => \config('constants.site.sms.sender'), 'message' => $message, 'to' => $to,
                    'type' => '0', 'routing' => 3, 'token' => \config('constants.smartsmssolutions.token')
                ]
            ]);
        } catch (\Exception $e) {
            Log::info('Cound not send Admin Notification Sms');
        }
    }
}
