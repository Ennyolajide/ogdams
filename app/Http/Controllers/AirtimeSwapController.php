<?php

namespace App\Http\Controllers;

use App\Airtime;
use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AirtimeSwaps extends TransactionController
{
    protected $modalResponse;
    protected $failureResponse = 'Airtime swap failed';

    /**
     * set success Response
     */
    protected function setModalResponse($network)
    {
        return (object)[
            'amount' => request()->amount,
            'timeOut' => $network->time_out,
            'processTime' => $network->process_time,
            'swapToPhone' => request()->swapToPhone,
            'transferCode' => $network->transfer_code,
            'swapFromPhone' => request()->swapFromPhone,
            'swapFromNetwork' => strtolower($network->network),
            'swapToNetwork' => strtolower(request()->swapToNetwork),
            'swapNumberOne' => $network->airtime_swap_phone_number_one,
            'swapNumberTwo' => $network->airtime_swap_phone_number_two,
            'swapedAmount' => floor($network->airtime_swap_percentage / 100 * request()->amount)
        ];
    }

    /**
     * get Airtime swap Numbers (numbers user will transfer airtime to for swaping)
     */
    protected function airtimeSwapNumbers($network)
    {
        $swapNum2 = $network->airtime_swap_phone_number_two ? ', ' . $network->airtime_swap_phone_number_two : '';
        return $network->airtime_swap_phone_number_one . $swapNum2;
    }

    /**
     * Store AirtimeSwap
     */
    protected function storeAirtimeSwaps($network, $airtimeSwapNumbers)
    {
        return Airtime::create([
            'user_id' => Auth::user()->id, 'amount' => request()->amount, 'percentage' => $network->airtime_swap_percentage,
            'from_network' => $network->network, 'from_phone' => request()->swapFromPhone, 'to_network' => request()->swapToNetwork,
            'to_phone' => request()->swapToPhone, 'class' => 'App\Airtime', 'type' => 'Airtime Swap', 'transaction_type' => 2,
            'recipients' => $airtimeSwapNumbers
        ]);
    }

    /**
     *  Execute AirtimeSwap
     */
    protected function airtimeSwap($network, $airtimeSwapNumbers)
    {
        $transactionRecord = $this->storeAirtimeSwaps($network, $airtimeSwapNumbers);
        $status = $transactionRecord ? true : false;
        $this->modalResponse = $status ? $this->setModalResponse($network) : false;
        $status ? $this->recordTransaction($transactionRecord, $this->getUniqueReference(), false, 'Airtime') : false;

        return $status;
    }
}

class AirtimeSwapController extends AirtimeSwaps
{
    public function index()
    {
        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status', true)->get();

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

        $airtimeSwapNumbers = $network ? $this->airtimeSwapNumbers($network) : false;

        $status = $network ? $this->airtimeSwap($network, $airtimeSwapNumbers) : false;

        $status ?  $this->notify($this->airtimeSwapNotification($network, $airtimeSwapNumbers)) : false;

        return $status;
    }
}
