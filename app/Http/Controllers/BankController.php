<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends PaystackController
{
    protected $existResponse = 'Account already exist!';
    protected $errorResponse = ' Failed, Pls try again later';
    protected $successResponse = ' Bank account added successfully';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Return Bank Accounts Details of the supplied account number and bank code
     */
    protected function resolveBankDetails()
    {
        //validate request()
        $this->validate(request(), [
            'bankName' => 'required|string',
            'bankCode' => 'required|min:3|max:5',
            'accountNumber' => 'required|string|min:10|max:10'
        ]);
        $query = request()->accountNumber . '&bank_code=' . request()->bankCode;

        return json_decode($this->getPaystack('bank/resolve?account_number=' . $query), true);
    }

    /**
     * Add a new Bank Account
     */
    public function storeBank()
    {
        $charges = Charge::whereService('addbank')->first()->amount;

        $bankDetails = $this->resolveBankDetails()['data'] ?? false;

        if (!$this->accountExist()) {
            if ($bankDetails && Auth::user()->balance >= $charges) {
                $status = $this->addBank($bankDetails) ? $this->debitWallet($charges) : false;
                $status ? $this->notify($this->addBankDetailsNotification($charges)) : false;
                $message = $status ? $this->successResponse : $this->errorResponse;
            } else {
                $status = false;
                $message = $this->failureResponse;
            }
        } else {
            $status = false;
            $message = $this->existResponse;
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Delete a bank account form DB
     */
    public function deleteBank(Bank $bank)
    {
        $status = $bank->delete();
        $message = $status ? 'Operation successful' : 'Operation failed';

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Check if account Exist
     */
    protected function accountExist()
    {
        return Bank::where('acc_no', request()->accountNumber)
            ->where('user_id', Auth::user()->id)
            ->first();
    }

    /**
     * Add the bank Details to DB
     */
    protected function addBank($bankDetails)
    {
        return Bank::create([
            'user_id' => Auth::user()->id,
            'bank_name' => request()->bankName,
            'acc_no' => $bankDetails['account_number'],
            'acc_name' => $bankDetails['account_name'],
        ]);
    }

    /**
     * Get the charges for the Adding a new Bank Account
     */
    protected function addBankDetailsCharges()
    {
        return 100;
    }
}
