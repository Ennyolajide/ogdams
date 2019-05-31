<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Transaction;
use App\CurrencyConverter;
use Illuminate\Support\Facades\Auth;

class CoinsController extends CurrencyConverterController
{
    public function index()
    {
        $coins = Coin::whereStatus(true)->get();

        return view('dashboard/coins/index', compact('coins'));
    }

    public function buy(Coin $coin)
    {
        $rate = $this->getExchangeRate();
        return view('dashboard/coins/buy', compact('coin', 'rate'));
    }

    public function sell(Coin $coin)
    {
        $transactions = Transaction::whereUser_id(Auth::user()->id)->first()->class;

        return view('dashboard/coins/sell', compact('coin'));
    }
}
