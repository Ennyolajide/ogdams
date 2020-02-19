<?php

namespace App\Http\Controllers;

use App\User;
use App\Bank;
use App\Airtime;
use App\Setting;
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
        $bvnVerificationSettings = Setting::whereName('bvn_verification')->first()->status;

        $verification = $bvnVerificationSettings ? Auth::user()->bvn_verified : true;

        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status', true)->whereAddon(false)->get();

        return $verification ?
            view('dashboard.airtime.cash', compact('networks')) :
            redirect(route('user.profile').'#verify')->withNotification($this->clientNotify('Please verify your account', false));
    }

    /**
     * Method to Initialize withdral
     */
    public function store()
    {

        $network = AirtimePercentage::find(request()->network);

        if (!$network) {
            return back();
        }

        //validation
        $this->validate(request(), [
            'network' => 'required|numeric',
            'swapFromPhone' => 'required|string|min:10|max:13',
            'amount'  => 'required|numeric|min:' . $network->airtime_to_cash_min . '|max:' . $network->airtime_to_cash_max,
        ]);

        $status = $this->processAirtimeToCash($network) ? true : false;

        return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
    }

    /**
     * Record Transaction
     */
    protected function processAirtimeToCash($network)
    {
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
        $this->modalResponse = $status ? $this->setModalResponse($transactionRecord->id, $network) : false;
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
            'class' => 'App\Airtime', 'type' => 'Airtime To Cash', 'transaction_type' => 2, 'status' => null,
            'recipients' => $network->airtime_to_cash_phone_numbers, 'bank_id' => null
        ]);
    }

    /**
     * set success Response
     */
    protected function setModalResponse($transactionRecordId, $network)
    {
        return (object) [
            'name' => 'AirtimeToCash',
            'amount' => request()->amount,
            'timeOut' => $network->time_out,
            'processTime' => $network->process_time,
            'transferCode' => $network->transfer_code,
            'airtimeRecordId' => $transactionRecordId,
            'swapFromPhone' => request()->swapFromPhone,
            'swapFromNetwork' => strtolower($network->network),
            'recipients' => json_decode($network->airtime_to_cash_phone_numbers),
            'walletAmount' => floor($network->airtime_swap_percentage / 100 * request()->amount)
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
