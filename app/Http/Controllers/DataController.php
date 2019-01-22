<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataPlan;
use App\Data;
use App\User;


class DataController extends WalletController
{


    public function index(){
        return view('dashboard.data.prices');
    }

    public function create(){
        $dataPlans = DataPlan::all();
        $networks = DataPlan::orderBy('network_id','asc')->distinct()->get(['network','network_id']);
        return view('dashboard.data.buy',compact('dataPlans','networks'));
    }

    public function store(){
        $this->validate(request(),['plan'=>'required|numeric|','phone'=>'required|numeric']);
        $dataPlan = DataPlan::find(request()->plan)->first();
        $response = $this->processDataPurchase($dataPlan);
        request()->session()->flash('response',$response);
        return back();
    }

    public function processDataPurchase($dataPlan){
        if(Auth::user()->balance >= $dataPlan->amount){
            $this->debitWallet($dataPlan->amount);
            Data::create([
                'user_id'      => Auth::user()->id,
                'amount'       => $dataPlan->amount,
                'network'      => $dataPlan->network,
                'volume'       => $dataPlan->volume,
                'phone'        => request()->phone
            ]);
            $response = 'Data Purchase successful';
        }else{
            $response = 'Insuffient balance, Pls fund your account';
        }
        return $response;
    }
}
