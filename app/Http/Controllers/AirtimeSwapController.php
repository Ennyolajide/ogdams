<?php

namespace App\Http\Controllers;

use App\Airtime;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class AirtimeSwapController extends TransactionController
{

    protected $modalResponse;
    protected $failureResponse = 'Airtime swap failed';
    protected $successResponse = 'Airtime swap request successful <br/> Pls wait while your transaction is been processed';


    public function index()
    {
        $networks = AirtimePercentage::where('airtime_swap_percentage_status', true)->get();

        return view('dashboard.airtime.swap', compact('networks'));
    }

    /**
     * Method to Initialize withdral
     */
    public function store()
    {
        //validation
        $this->validate(request(), [
            'amount'  => 'required|numeric',
            'network' => 'required|numeric',
            'swapToNetwork' => 'required|string',
            'swapToPhone' => 'required|string|min:10|max:13',
            'swapFromPhone' => 'required|string|min:10|max:13',
        ]);

        $status = $this->processAirtimeSwap() ? true : false;

        return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
    }

    /**
     * Record Transaction
     */
    protected function processAirtimeSwap()
    {
        $network = AirtimePercentage::find(request()->network);

        $status = $network ? $this->airtimeSwap($network) : false;

        return $status;
    }

    /**
     *  Execute airtimeSwap
     */
    protected function airtimeSwap($network)
    {
        $transactionRecord = $this->storeAirtimeSwap($network);
        $status = $transactionRecord ? true : false;
        $this->modalResponse = $status ? $this->setModalResponse($transactionRecord->id, $network) : false;
        $status ? $this->recordTransaction($transactionRecord, $this->getUniqueReference(), false, false, 'Airtime', true)->update(['status' => null]) : false;

        return $status;
    }

    /**
     * Store airtimeSwap
     */
    protected function storeAirtimeSwap($network)
    {
        return Airtime::create([
            'user_id' => Auth::user()->id, 'amount' => request()->amount, 'percentage' => $network->airtime_swap_percentage,
            'from_network' => $network->network, 'from_phone' => request()->swapFromPhone, 'to_network' => request()->swapToNetwork,
            'to_phone' => request()->swapToPhone, 'class' => 'App\Airtime', 'type' => 'Airtime Swap', 'transaction_type' => 3, 'status' => null,
            'recipients' => $network->airtime_to_cash_phone_numbers
        ]);
    }

    /**
     * set success Response
     */
    protected function setModalResponse($transactionRecordId, $network)
    {
        return (object) [
            'name' => 'airtimeSwap',
            'amount' => request()->amount,
            'processTime' => $network->process_time,
            'swapToPhone' => request()->swapToPhone,
            'transferCode' => $network->transfer_code,
            'airtimeRecordId' => $transactionRecordId,
            'swapFromPhone' => request()->swapFromPhone,
            'swapFromNetwork' => strtolower($network->network),
            'recipients' => json_decode($network->airtime_to_cash_phone_numbers),
            'swapedAmount' => floor($network->airtime_swap_percentage / 100 * request()->amount)
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
