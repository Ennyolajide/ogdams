<?php

namespace App\Http\Controllers\Control;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends ModController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $transactions = Transaction::orderBy('id', 'desc')->paginate(20);

        return view('control.transactions', compact('transactions'));
    }
}
