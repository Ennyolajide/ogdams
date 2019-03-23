<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class CoinsController extends WalletController
{
    public function index()
    {
        $coins = Coin::whereStatus(true)->get();

        return view('dashboard/coins/index', compact('coins'));
    }

    public function buy(Coin $coin)
    {
        return view('dashboard/coins/buy', compact('coin'));
    }

    public function sell(Coin $coin)
    {
        $transactions = Transaction::whereUser_id(Auth::user()->id)->first()->class;

        return view('dashboard/coins/sell', compact('coin'));
    }
}
