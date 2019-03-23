<?php

namespace App\Http\Controllers;

use App\AirtimePercentage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AirtimeSwapController extends walletController
{
    public function index()
    {
        $percentages = AirtimePercentage::where('airtime_swap_percentage_status', true)->get();

        return view('dashboard.airtime.swap', compact('percentages'));
    }

    public function store()
    {
        $data = request()->validate([
            'from_network' => 'required',
            'to_network' => 'required',
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id;
        AirtimeSwap::create($data);
        $response = 'Pls check your dashboard inbox to complete your order';

        request()->session()->flash('response', $response);

        return request();
    }

    public function sendSwapInstruction($data)
    {
        $message = 'To complete your order Kindly send '.
        Message::create($message);
    }
}
