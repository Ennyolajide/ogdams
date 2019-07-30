<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends TransactionController
{
    /**
     * Record Payment
     */
    public function storePayment($object, $status)
    {
        return Payment::create([
            'user_id' => Auth::user()->id, 'amount' => ($object['amount'] / 100),
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
        //Record payments of reference does not exist in db
        $paymentRecord = $doesNotExist ? $this->storePayment($object, $status) : false;
        //credit Wallet if payment was successful and also if reference doest not exist in db
        $credited = $status ? $this->creditWallet($object['amount'] / 100) : false;
        //record transaction it reference doest not exist in db
        $doesNotExist ? $this->recordTransaction($paymentRecord, $this->getUniqueReference(), $status, false, 'Card') : false;

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
}
