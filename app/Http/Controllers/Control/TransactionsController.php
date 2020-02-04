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
    
    public function searchIndex()
    {
        return view('control.transactionSearch');
    }


    public function searchTransactions()
    {
        $this->validate(request(), ['reference' => 'required|string|min:3']);

        return Transaction::where('reference', 'like', '%' . request()->reference . '%')->get()->map(function ($item, $key) {
            $item['user'] = $item->user;
            $item['record'] = $item->class;
            $item['type'] = $item->class->type;

            return $item;
        });

    }
}
