<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentGateway;
use App\AirtimePercentage;
use App\Airtime;
use App\Bank;
use App\Voucher;
use App\User;
use App\Message;

class WalletController extends PaymentController
{
    //
    protected $sender = 1;
    protected $subject = 'Wallet Funding';


    public function creditWallet($amount){
        $user = User::find(Auth::user()->id);
        $user->balance = Auth::user()->balance + $amount;
        $user->save();
        $this->fundingMessage($amount);
        return true;
    }

    public function debitWallet($amount){
        $user = User::find(Auth::user()->id);
        $user->balance = Auth::user()->balance - $amount;
        $user->save();
        return true;
    }

    public function fundingMessage($amount){
        $data = [
            'sender_id' => $this->sender,
            'user_id' => Auth::user()->id,
            'subject' => $this->subject,
            'content' => 'You have successfully funded your wallet with '.$amount
        ];
        Message::create($data);
    }


    public function create(){
        $gateways = PaymentGateway::where('status',true)->get();
        $networks = AirtimePercentage::where('airtime_to_cash_percentage_status',true)->get();
        return view('dashboard.wallet.fund',compact('gateways','networks'));
    }

    public function store(){
        if(request()->gateway == 1) return $this->fundWithAirtime();
        if(request()->gateway == 2) return $this->redirectToGateway();
        if(request()->gateway == 3) return $this->bankTransfer();
        if(request()->gateway == 4) $this->fundWithBitcoin();
        if(request()->gateway == 5) return $this->voucher();

    }

    public function fundWithAirtime(){
        $this->validate(request(),['from' => 'required|min:11|max:11', 'airtime_amount' => 'required|numeric']);
        $network = AirtimePercentage::findOrFail(request()->network);
        $input = [
            'user_id' => Auth::user()->id,
            'percentage' => $network->airtime_to_cash_percentage,
            'amount' => request()->airtime_amount,
            'network' => $network->network,
            'from_phone' => request()->from,
            'to_phone' => '08033353290',
            'transaction_type' => 5
        ];
        Airtime::create($input);
        request()->session()->flash('amount',request()->airtime_amount);
        request()->session()->flash('network',request()->network);
        request()->session()->flash('networkName',$input['network']);
        request()->session()->flash('to','08033353290');
        return redirect('dashboard/wallet/fund/airtime');
    }



    public function fundWithBitcoin(){

    }


    public function airtime(){
        if(!request()->session()->has('to')){ return redirect(route('wallet.fund')); }
        return view('dashboard/wallet/airtime');
    }
}
