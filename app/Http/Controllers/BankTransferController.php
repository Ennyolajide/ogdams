<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Transaction;
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
        $status ? $this->recordBankTransaction($transactionRecord, $this->getUniqueReference(), false, false, 'Bank', false)->update(['status' => null]) : false;

        return $status;
    }

    /**
     * Store Bank Transfer
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
     * Record Transaction
     */
    protected function recordBankTransaction($transactionRecord, $reference, $status = false, $chargeable = true, $method = false, $isInstant = false)
    {
        $balanceAfter = $chargeable ? (Auth::user()->balance - $transactionRecord->amount) : Auth::user()->balance;

        return Transaction::create([
            'user_id' => $transactionRecord->user_id, 'amount' => $transactionRecord->amount,
            'balance_before' => Auth::user()->balance, 'balance_after' => $balanceAfter,
            'class_type' => $transactionRecord->class, 'class_id' => $transactionRecord->id,
            'reference' => $reference, 'method' => $method ? $method : 'Wallet', 'status' => $status ? 2 : ($isInstant ? 0 : 1)
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
