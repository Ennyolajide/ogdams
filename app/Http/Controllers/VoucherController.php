<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Voucher;
use App\User;

class VoucherController extends WalletController
{
    //

    public function index(){

    }

    public function markVoucherAsUsed($voucher){
        $voucher = Voucher::where('voucher',request()->voucher)->first();
        $voucher->user_id = Auth::user()->id;
        $voucher->status = false;
        $voucher->update();
    }

    public function fundWithVoucher(){
        $this->validate(request(),['voucher' => 'required|min:16|max:20']);
        $voucher = Voucher::where('voucher',request()->voucher)->first();
        if(empty($voucher) || $voucher->user_id || !$voucher->status){
            $response = 'Voucher has been used by another user or it does not exist.';
            $status = false;
        }else{
            $this->creditWallet($voucher->value);
            $this->markVoucherAsUsed($voucher);
            $response = 'Wallet funding successful';
            $status = true;
        }
        request()->session()->flash('response',$response);
        request()->session()->flash('status',$status);
        return back();
    }
}
