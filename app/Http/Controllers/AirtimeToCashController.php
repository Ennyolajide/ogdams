<?php

namespace App\Http\Controllers;

use App\User;
use App\Bank;
use App\Airtime;
use App\Transaction;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirtimeToCashController extends TransactionController
{
    //
    protected $modalResponse;
    protected $failureResponse = 'Airtime to cash failed';
    protected $successResponse = 'Airtime to cash request successful <br/> Pls wait while your transaction is been processed';


    public function index()
    {
        $banks = User::find(Auth::user()->id)->banks;
        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status', true)->get();

        return view('dashboard.airtime.cash', compact('networks','banks'));
    }

    /**
     * Method to Initialize withdral
     */
    public function store()
    {
        //return request()->all();
        //validation
        $this->validate(request(), [
            'amount'  => 'required|numeric',
            'network' => 'required|numeric',
            'bankId' => 'required|numeric|exists:banks,id',
            'swapFromPhone' => 'required|string|min:10|max:13',
        ]);

        $status = $this->processAirtimeToCash() ? true : false;

        return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
    }

    /**
     * Record Transaction
     */
    protected function processAirtimeToCash()
    {
        $network = AirtimePercentage::find(request()->network);

        $status = $network ? $this->airtimeToCash($network) : false;

        return $status;
    }

    /**
     *  Execute AirtimeToCash
     */
    protected function airtimeToCash($network)
    {
        $transactionRecord = $this->storeAirtimeToCash($network);
        $status = $transactionRecord ? true : false;
        $this->modalResponse = $status ? $this->setModalResponse($transactionRecord->id,$network) : false;
        $status ? $this->recordTransaction($transactionRecord, $this->getUniqueReference(), false, false, 'Airtime', true)->update(['status' => null]) : false;

        return $status;
    }

    /**
     * Store AirtimeToCash
     */
    protected function storeAirtimeToCash($network)
    {
        return Airtime::create([
            'user_id' => Auth::user()->id, 'amount' => request()->amount, 'from_network' => $network->network,
            'percentage' => $network->airtime_swap_percentage, 'from_phone' => request()->swapFromPhone,
            'class' => 'App\Airtime', 'type' => 'Airtime To Cash', 'transaction_type' => 2,'status' => null,
            'recipients' => $network->airtime_to_cash_phone_numbers, 'bank_id' => request()->bankId
        ]);
    }

    /**
     * set success Response
     */
    protected function setModalResponse($transactionRecordId,$network)
    {
        return (object)[
            'name' => 'AirtimeToCash',
            'amount' => request()->amount,
            'timeOut' => $network->time_out,
            'processTime' => $network->process_time,
            'transferCode' => $network->transfer_code,
            'airtimeRecordId' => $transactionRecordId,
            'swapFromPhone' => request()->swapFromPhone,
            'bankDetails' => Bank::find(request()->bankId),
            'swapFromNetwork' => strtolower($network->network),
            'recipients' => json_decode($network->airtime_to_cash_phone_numbers),
            'walletAmount' => floor($network->airtime_swap_percentage / 100 * request()->amount)
        ];
    }

    public function completed(Airtime $airtimeRecord){

        $status = $airtimeRecord->update(['status' => 1 ]) ? true : false;

        $status ? $airtimeRecord->transaction->first()->update(['status' => 1 ]) : false;

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));

    }

}
