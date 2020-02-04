<?php

namespace App\Http\Controllers;

use App\User;
use App\Payment;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    protected $user;
    /**
     * Record Payment
     */
    public function storePayment($object, $user, $status)
    {
        return Payment::create([
            'user_id' => $user->id, 'amount' => ($object['metadata']['amount'] / 100),
            'object' => json_encode($object, true), 'type' => 'Card Payment', 'class' => 'App\Payment',
            'transaction_type' => 1, 'reference' => $object['reference'], 'status' => $status ? 2 : 0
        ]);
    }

    /**
     * Execute wallet funding
     */
    protected function fundUserWallet($object)
    {
        //check if status does not exist in the db
        $doesNotExist = $this->referenceDoesNotExist($object);
        //check the status of the payment object and also make sure reference doest not exist in db
        $status = ($object['status'] === 'success' && $doesNotExist) ? true : false;
        //get User( transaction owner)
        $user = User::whereEmail($object['customer']['email'])->first();
        //Record payments of reference does not exist in db
        $amount = ($object['metadata']['amount'] / 100);
        $paymentRecord = $doesNotExist ? $this->storePayment($object, $user, $status) : false;
        //Credit Referral Bonus
        $referralBonus = $user->first_time_funding && $user->referrer ? $this->addReferrerBonus($user) : 0;
        //record transaction it reference doest not exist in db
        $doesNotExist ? $this->recordPaystackTransaction($user, $referralBonus, $paymentRecord, $this->getUniqueReference(), $status, 'Card', true) : false;
        //credit Wallet if payment was successful and also if reference doest not exist in db
        $credited = $status ? $this->creditUserWallet($user->id, ($amount - $referralBonus)) : false;
        //send message to inbox about what just happen
        $credited ? $this->notifyUser($user->id, $this->cardPaymentNotification($amount - $referralBonus)) : false;

        return $status;
    }

    /**
     * Check if reference do not exist in the db
     */
    protected function referenceDoesNotExist($object)
    {
        $referenceExist = Payment::whereReference($object['reference'])->first();
        return $referenceExist ? false : true;
    }

    /**
     * Record Payment Transaction
     */
    protected function recordPaystackTransaction($user, $referralBonus, $transactionRecord, $reference, $status = false, $method = false, $isInstant = false)
    {
        $balanceAfter = $user->balance + ($transactionRecord->amount - $referralBonus);

        return Transaction::create([
            'user_id' => $transactionRecord->user_id, 'amount' => $transactionRecord->amount,
            'balance_before' => $user->balance, 'balance_after' => $balanceAfter,
            'class_type' => $transactionRecord->class, 'class_id' => $transactionRecord->id,
            'reference' => $reference, 'method' => $method ? $method : 'Wallet', 'status' => $status ? 2 : ($isInstant ? 0 : 1)
        ]);
    }

    protected function cardPaymentNotification($amount)
    {
        $notification['subject'] = 'Credit Notification';
        $notification['content'] = 'Your wallet has been credited with ' . $this->naira($amount);
        $notification['content'] .= ' using Card Payment ';

        return $notification;
    }
}
