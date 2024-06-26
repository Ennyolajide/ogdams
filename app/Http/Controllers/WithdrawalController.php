<?php

namespace App\Http\Controllers;


use App\User;
use App\Charge;
use App\Setting;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends TransactionController
{
    protected $failureResponse = 'Insuffient balance, Pls fund your account';
    protected $successResponse = 'Withdrawal request successful <br/> Please wait while your request is been proccess';

    /**
     * Display Withdraw (if at least one bank account is connected )else( redirect to profile page)
     */
    public function index()
    {

        $bvnVerificationSettings = Setting::whereName('bvn_verification')->first()->status;

        $verification = $bvnVerificationSettings ? Auth::user()->bvn_verified : true;

        if($verification){
            $banks = User::find(Auth::user()->id)->banks;
            if ($banks->count()) {
                $charge = Charge::whereService('withdrawals')->first()->amount;
                return view('dashboard.wallet.withdraw', compact('banks', 'charge'));
            } else {
                $message = 'Please Add at least one Bank to your Profile';
                return redirect(route('user.profile').'#bank')->withNotification($this->clientNotify($message, false));
            }
        }else{
            return redirect(route('user.profile').'#verify')->withNotification($this->clientNotify('Please verify your account', false));
        }

    }

    /**
     * Method to Initialize withdral
     */
    public function store()
    {
        $this->validate(request(), [
            'amount'  => 'required|numeric',
            'bankId'  => 'required|numeric'
        ]);

        $status = $this->processWithdrawal() ? true : false;
        $message = $status ? $this->successResponse : $this->failureResponse;

        return request()->wantsJson() ?
            response()->json(['status' => $status, 'response' => $message])
            : back()->withNotification($this->clientNotify($message, $status));
    }


    /**
     * Record Transaction
     */
    protected function processWithdrawal()
    {
        $this->withdrawalCharges = Charge::whereService('withdrawals')->first()->amount;

        if (Auth::user()->balance >= (request()->amount + $this->withdrawalCharges)) {

            $status = $this->withdraw();

            $status ?  $this->notify($this->withdrawalNotification(request()->amount)) : false;

            return $status;
        }
    }

    /**
     * Store Withdrawals
     */
    protected function storeWithdrawals()
    {
        return Withdrawal::create([
            'user_id' => Auth::user()->id, 'amount' => request()->amount,
            'bank_id' => request()->bankId, 'class' => 'App\Withdrawal', 'type' => 'Withdrawal',
        ]);
    }

    /**
     *  Execute withdrawal
     */
    protected function withdraw()
    {
        $transactionRecord = $this->storeWithdrawals();
        $status = $transactionRecord ? $this->debitWallet(request()->amount + $this->withdrawalCharges) : false;
        $status ? $this->recordTransaction($transactionRecord, $this->getUniqueReference(), false, true) : false;

        return $status;
    }
}
