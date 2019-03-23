<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankTransferController extends WalletController
{
    protected $successResponse = 'Pls wait while we confirm process your transaction';
    protected $failureResponse = '';

    public function create()
    {
        $banks = Bank::where('user_id', 1)->get();

        return request()->has('amount') ?
            view('dashboard/wallet/bank', compact('banks'))->with('amount', request()->amount) :
            redirect(route('wallet.fund'));
    }

    public function store()
    {
        $input = request()->validate([
            'amount' => 'required|numeric',
            'bank_id' => 'required|numeric',
        ]);

        $input['user_id'] = Auth::user()->id;

        $response = BankTransfer::create($input) ? $this->successResponse : $this->failureResponse;

        return redirect()->route('wallet.fund')->withResponse($response);
    }
}
