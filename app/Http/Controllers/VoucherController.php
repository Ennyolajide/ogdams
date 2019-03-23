<?php

namespace App\Http\Controllers;

use App\User;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends WalletController
{
    public function markVoucherAsUsed($voucher)
    {
        $voucher = Voucher::where('voucher', request()->voucher)->first();
        $voucher->user_id = Auth::user()->id;
        $voucher->status = false;
        $voucher->update();
    }

    public function store()
    {
        $response = 'Voucher has been used by another user or it does not exist.';
        $this->validate(request(), ['voucher' => 'required|min:16|max:20']);
        $voucher = Voucher::where('voucher', request()->voucher)->first();
        if (!empty($voucher) || !$voucher->user_id || $voucher->status) {
            $notification = $this->creditNotification($voucher->value);
            $notification['content'] .= ' through Voucher Pin';
            $this->creditWallet($voucher->value, $notification);
            $this->markVoucherAsUsed($voucher);
            $response = 'Wallet funding successful';
        }

        return back()->with('response', $response);
    }
}
