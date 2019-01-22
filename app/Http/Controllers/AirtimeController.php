<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AirtimePercentage;
use App\Airtime;

class AirtimeController extends Controller
{
    //

    public function cash(){
        $percentages = AirtimePercentage::where('airtime_to_cash_percentage_status',true)->get();
        return view('dashboard.airtime.cash',compact('percentages'));
    }


    public function fundWithAirtime(){
        $this->validate(request(),['from' => 'required|min:11|max:11', 'airtime_amount' => 'required|numeric']);
        $network = AirtimePercentage::find(request()->network);
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

    public function getActivePhone($networkId){


    }

    public function swap(){
        $percentages = AirtimePercentage::where('airtime_swap_percentage_status',true)->get();
        /* $nums = ['07063637002','1234567890','0902233445566'];
        return  serialize($nums); */
        return $percentages->airtime_to_cash_phone_numbers;
        return view('dashboard.airtime.swap',compact('percentages'));
    }

    public function airtimeSwap(){
        $data = request()->validate([
            'from_network'=>'required',
            'to_network'=>'required',
            'from'=>'required',
            'to'=>'required',
            'amount'=>'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        AirtimeSwap::create($data);
        $response = 'Pls check your dashboard inbox to complete your order';

        request()->session()->flash('response',$response);
        return request();
    }

    public function sendSwapInstruction($data){
        $message = 'To complete your order Kindly send '.
        Message::create($message);

    }
}
