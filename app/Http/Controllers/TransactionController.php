<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends ReferralController
{
    public function transactionIndex()
    {
        $rowsPage = request()->wantsJson() ? 50 : 15;
        $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate($rowsPage);

        return request()->wantsJson() ?
            response()->json($transactions, 200) : view('dashboard/transactions/index', compact('transactions'));
    }

    public function reference($reference)
    {
        $transaction = Transaction::whereReference($reference)->where('user_id', Auth::user()->id)->first();

        return request()->wantsJson() ? response()->json($transaction, 200) : [];
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



    /**
     * Record Payment Transaction
     */
    protected function recordPaystackTransaction($user, $referralBonus, $transactionRecord, $reference, $status = false, $method = false, $isInstant = false)
    {
        $balanceAfter = $user->balance + ($transactionRecord->amount - $referralBonus);

        return Transaction::create([
            'user_id' => $transactionRecord->user_id, 'amount' => $transactionRecord->amount,
            'balance_before' => $user->balance, 'balance_after' => $balanceAfter,
            'class_type' => $transactionRecord->class, 'class_id' => $transactionRecord->id,
            'reference' => $reference, 'method' => $method ? $method : 'Wallet', 'status' => $status ? 2 : ($isInstant ? 0 : 1)
        ]);
    }
}
