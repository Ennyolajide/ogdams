<?php

namespace App\Http\Controllers;

use App\Airtime;
use App\Transaction;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirtimeFundingController extends WalletController
{

    protected $modalResponse;
    protected $failureResponse = 'Airtime wallet funding failed';
    protected $successResponse = 'Airtime wallet funding request successful <br/> Pls wait while your transaction is been processed';


    /**
     * Method to Initialize withdral
     */
    public function store()
    {
        //return request()->all();
        //validation
        $this->validate(request(), [
            'airtimeAmount'  => 'required|numeric',
            'network' => 'required|numeric',
            'swapFromPhone' => 'required|string|min:10|max:13',
        ]);

        $status = $this->processAirtimeFunding() ? true : false;

        return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
    }

    /**
     * Record Transaction
     */
    protected function processAirtimeFunding()
    {
        $network = AirtimePercentage::find(request()->network);

        $status = $network ? $this->airtimeFunding($network) : false;

        return $status;
    }

    /**
     *  Execute AirtimeToCash
     */
    protected function airtimeFunding($network)
    {
        $transactionRecord = $this->storeAirtimeFunding($network);
        $status = $transactionRecord ? true : false;
        $this->modalResponse = $status ? $this->setModalResponse($transactionRecord->id, $network) : false;
        $status ? $this->recordTransaction($transactionRecord, $this->getUniqueReference(), false, false, 'Airtime', false)->update(['status' => null]) : false;

        return $status;
    }

    /**
     * Store AirtimeToCash
     */
    protected function storeAirtimeFunding($network)
    {
        return Airtime::create([
            'user_id' => Auth::user()->id, 'amount' => request()->airtimeAmount, 'from_network' => $network->network, 'status' => null,
            'percentage' => $network->airtime_swap_percentage, 'from_phone' => request()->swapFromPhone, 'class' => 'App\Airtime',
            'type' => 'Airtime Funding', 'transaction_type' => 4, 'recipients' => $network->airtime_to_cash_phone_numbers
        ]);
    }

    /**
     * set success Response
     */
    protected function setModalResponse($transactionRecordId, $network)
    {
        return (object) [
            'name' => 'AirtimeFunding',
            'amount' => request()->airtimeAmount,
            'processTime' => $network->process_time,
            'swapToPhone' => request()->swapToPhone,
            'airtimeRecordId' => $transactionRecordId,
            'transferCode' => $network->transfer_code,
            'swapFromPhone' => request()->swapFromPhone,
            'swapFromNetwork' => strtolower($network->network),
            'recipients' => json_decode($network->airtime_to_cash_phone_numbers),
            'walletAmount' => floor($network->airtime_swap_percentage / 100 * request()->airtimeAmount)
        ];
    }

    public function completed(Airtime $airtimeRecord)
    {

        $status = $airtimeRecord->update(['status' => 1]) ? true : false;

        $status ? $airtimeRecord->transaction->first()->update(['status' => 1]) : false;

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
