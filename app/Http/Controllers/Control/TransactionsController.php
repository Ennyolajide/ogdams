<?php

namespace App\Http\Controllers\Control;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;
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
        $users = User::all()->count();
        $totalTrans = Transaction::whereStatus('2')->count();
        $transactions = Transaction::whereStatus(!NULL)->take(50)->latest()->get();

        return view('control.transactions', compact('transactions', 'totalTrans', 'users'));
    }
}
