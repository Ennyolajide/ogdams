<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;

class BankTransferController extends WalletController
{
    protected $successResponse = 'Pls wait while we confirm process your transaction';
    protected $failureResponse = '';

    public function store()
    {
        $this->validate(request(), [
            'remarks' => 'sometimes',
            'reference' => 'sometimes',
            'amount' => 'required|numeric',
            'depositor' => 'required|string',
            'bankId' => 'required|numeric|exists:banks,id',
        ]);

        $status = $this->bankTransfer() ? true : false;

        return $status ? back()->withModal($this->modalResponse) : back()->withNotification($this->clientNotify($this->failureResponse, $status));
    }



    /**
     *  Execute AirtimeToCash
     */
    protected function bankTransfer()
    {
        $transactionRecord = $this->storeBankTransfer();
        $status = $transactionRecord ? true : false;
        $this->modalResponse = $status ? $this->setModalResponse($transactionRecord) : false;
        $status ? $this->recordTransaction($transactionRecord, $this->getUniqueReference(), false, false, 'Bank', false)->update(['status' => null]) : false;

        return $status;
    }

    /**
     * Store AirtimeToCash
     */
    protected function storeBankTransfer()
    {
        return BankTransfer::create([
            'user_id' => Auth::user()->id, 'amount' => request()->amount, 'bank_id' => request()->bankId,
            'details' => json_encode(['depositor' => request()->depositor, 'reference' => request()->reference, 'remarks' => request()->remarks]),
            'class' => 'App\BankTransfer', 'type' => 'Bank Transfer', 'status' => null,
        ]);
    }

    /**
     * set success Response
     */
    protected function setModalResponse($transactionRecord)
    {
        return (object) [
            'name' => 'BankTransfer',
            'amount' => request()->amount,
            'record' => $transactionRecord,
            'remarks' => request()->remarks,
            'bank' => $transactionRecord->bank,
            'reference' => request()->reference,
            'depositor' => request()->depositor,
        ];
    }

    public function completed(BankTransfer $bankTransferRecord)
    {
        $status = $bankTransferRecord->update(['status' => 1]) ? true : false;

        $status ? $bankTransferRecord->transaction->first()->update(['status' => 1]) : false;

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
