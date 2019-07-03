<?php

namespace App\Http\Controllers\Bills;

use App\Bill;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillController extends RingoController
{
    protected $successResponse = ' Topup successful';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Store Tv Payments
     */
    protected function storeTopup($details, $status)
    {
        return Bill::create([
            'user_id' => Auth::user()->id, 'amount' => $details['amount'], 'details' => json_encode($details),
            'class' => 'App\Bill', 'type' => $details['type'], 'status' => $status ? 2 : 0, 'product' => $details['product'],
        ]);
    }

    /**
     *  Execute Bill Topup
     */
    protected function topup($product, $details, $isElectricity = false)
    {
        $response = $isElectricity ? $this->electricityTopup($product) : $this->tvInternetMiscTopup($product);
        $status = $response ? $this->debitWallet($details['amount']) : false;
        $this->failureResponse = $response ? $this->failureResponse : $product->name . ' ' . $this->apiErrorResponse;
        $tvTopupRecord = $this->storeTopup($details, $status);
        $this->recordTransaction($tvTopupRecord, $this->getUniqueReference(), $status, $status, false, true);

        return $status;
    }
}
