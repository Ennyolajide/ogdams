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

    public function userTransactions(User $user)
    {
        $transactions = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(20);

        return view('control.userTransactions', compact('user', 'transactions'));
    }
}
