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
        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status', true)->whereAddon(false)->get();

        $networks->makeHidden([
            'addon','group_network','has_addon','alternate_name','created_at',
            'airtime_swap_percentage','airtime_swap_percentage_status','updated_at',
            'airtime_to_cash_percentage_status','airtime_topup_ussd_code','airtime_topup_status',
            'airtime_topup_sim_route','airtime_topup_percentage','hosted_sim_api_token','hosted_sim_server_token',
        ]);

        return request()->wantsJson() ? response()->json($networks, 200) : view('dashboard.airtime.cash', compact('networks'));
    }

    /**
     * Method to Initialize withdral
     */
    public function store()
    {
        $network = AirtimePercentage::whereId(request()->network)
            ->where('airtime_to_cash_percentage_status', true)->first();
        if (!$network) {
            return request()->wantsJson() ? response()->json(['status' => false, 'response' => 'Invalid Network'],200) : back();
        }
        //validation
        $this->validate(request(), [
            'swapFromPhone' => 'required|string|min:10|max:13',
            'network' => ['bail', 'required', 'numeric', function ($attribute, $value, $fail) use ($network) {
                $network ? false : $fail('Network not available at the moment');
            }],
            'amount'  => $network ? 'required|numeric|min:' . $network->airtime_to_cash_min . '|max:' . $network->airtime_to_cash_max : '',
        ]);

        $status = $this->processAirtimeToCash($network) ? true : false;

        if(request()->wantsJson()){
            return response()->json(['status' => $status, 'response' => $status ? $this->modalResponse : $this->failureResponse ],200);
        }else{
            return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
        }

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
            'percentage' => $network->airtime_to_cash_percentage, 'from_phone' => request()->swapFromPhone,
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
            'walletAmount' => floor($network->airtime_to_cash_percentage / 100 * request()->amount)
        ];
    }

    public function completed(Airtime $airtimeRecord)
    {
        $status = $airtimeRecord->update(['status' => 1]) ? true : false;

        $status ? $airtimeRecord->transaction->first()->update(['status' => 1]) : false;

        $message = $status ? $this->successResponse : $this->failureResponse;

        return request()->wantsJson() ?
            response()->json(['status' => $status, 'response' => $message ])
            : back()->withNotification($this->clientNotify($message, $status));
    }
}
