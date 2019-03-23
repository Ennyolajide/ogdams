<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

        return view('dashboard/transactions', compact('transactions'));
    }
}
