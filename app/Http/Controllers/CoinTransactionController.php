<?php

namespace App\Http\Controllers;


use App\Coin;
use App\CoinTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoinPurchaseController extends CoinsController
{

    protected $failureResponse = 'Insuffient balance, Pls fund your account';
    protected $successResponse = 'Coin Purchase successful <br/> <p class="text-center">Pls wait while the coin is been automatically transfered to your wallet</p>';

    /**
     * Get coin Buying Rate
     */
    public function buyRate($coin)
    {
        return ($this->getExchangeRate() + $coin->buy_rate);
    }

    /**
     * Record CoinTransactions Topup
     */
    public function saveCoinTransaction($coin, $amount, $rate)
    {
        return CoinTransaction::create([
            'user_id' => Auth::user()->id, 'amount' => $amount, 'rate' => $rate, 'class' => 'App\CoinTransaction',
            'wallet' => request()->wallet, 'type' => ucfirst($coin->name) . (request()->wallet ? ' Purchase' : ' Exchange')
        ]);
    }

    /**
     *  Execute Coin Transaction
     */
    public function purchaseCoin($coin, $amount, $rate)
    {
        $reference = $this->getUniqueReference();
        $transactionRecord = $this->saveCoinTransaction($coin, $amount, $rate);
        $status = $transactionRecord ? $this->debitWallet($amount) : false;
        $status ? $this->recordTransaction($transactionRecord, $reference, false, true) : false;

        return $status;
    }
}



class CoinTransactionController extends CoinPurchaseController
{

    public function purchase()
    {
        //validation
        $this->validate(request(), [
            'amount'  => 'required|numeric|min:2|max:5',
            'wallet' => 'required|string|min:26|max35',
        ]);

        //get the coin object
        $coin = Coin::find(request()->coinId);
        //set the amount equals rate multipy by the amount requested
        $rate = $this->buyRate($coin);
        $amount = $rate * request()->amount;
        //check if user have enough balance to continue
        if (Auth::user()->balance >= $amount) {

            $status = $coin ? $this->purchaseCoin($coin, $amount, $rate) : false;
            $status ? $this->notify($this->coinPurchaseNotification($amount, $coin->name)) : false;
        } else {
            $status = false;
        }
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
