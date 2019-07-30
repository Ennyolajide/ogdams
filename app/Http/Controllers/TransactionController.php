<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends NotificationController
{
    public function transactionIndex()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(2);

        return view('dashboard/transactions/index', compact('transactions'));
    }


    /**
     * Record Transaction
     */
    protected function recordTransaction($transactionRecord, $reference, $status = false, $chargeable = true, $method = false, $isInstant = false)
    {
        $balanceAfter = $chargeable ? (Auth::user()->balance - $transactionRecord->amount) : Auth::user()->balance;

        return Transaction::create([
            'user_id' => $transactionRecord->user_id, 'amount' => $transactionRecord->amount,
            'balance_before' => Auth::user()->balance, 'balance_after' => $balanceAfter,
            'class_type' => $transactionRecord->class, 'class_id' => $transactionRecord->id,
            'reference' => $reference, 'method' => $method ? $method : 'Wallet', 'status' => $status ? 2 : ($isInstant ? 0 : 1)
        ]);
    }
}
