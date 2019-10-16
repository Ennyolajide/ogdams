<?php

namespace App\Http\Controllers\Control;

use App\User;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ReferralController;
use Illuminate\Support\Facades\Auth;

class ModController extends ReferralController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all()->count();
        $totalTrans = Transaction::whereStatus('2')->count();
        $transactions = Transaction::whereStatus(!NULL)->take(20)->latest()->get();

        return view('control.index', compact('transactions', 'totalTrans', 'users'));
    }
}
