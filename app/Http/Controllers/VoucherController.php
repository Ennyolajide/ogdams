<?php

namespace App\Http\Controllers;

use App\User;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends WalletController
{
    protected $successResponse = 'Wallet funding successful';
    protected $failureResponse = 'Voucher has been used by another user or it does not exist.';

    /**
     * Mark Voucher as used
     */
    public function markVoucherAsUsed($voucher)
    {
        return $voucher->update(['user_id' => Auth::user()->id, 'status' => false]) ? true : false;
    }

    public function store()
    {
        //validate post data
        $this->validate(request(), ['voucher' => 'required|min:16|max:20']);

        // get voucher pin
        $voucher = Voucher::whereVoucher(request()->voucher)->first();
        //check if the voucher is valid and it has not been used
        if (empty($voucher) || !$voucher->user_id || $voucher->status) {
            //mark Voucher as used to prevent multiple usage
            $marked = $this->markVoucherAsUsed($voucher) ? true : false;
            //credit user wallet with the voucher's value
            $status = $marked ? $this->creditWallet($voucher->value) : false;
            //send message to inbox about what just happen
            $status ? $this->notify($this->voucherWalletFundingNotification($voucher)) : false;
            //set success / failure message for user
            $message = $status ? $this->successResponse : $this->failureResponse;
            //redirect back and show message
            return back()->withNotification($this->clientNotify($message, $status));
        }
    }
}
