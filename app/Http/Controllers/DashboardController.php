<?php

namespace App\Http\Controllers;

use App\User;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        request()->wantsJson() ? $this->middleware('auth:api') : $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardIndex()
    {
        $referrals = User::where('referrer', Auth::user()->wallet_id);

        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->take(10)->latest()->get();
        return view('dashboard.index', compact('transactions', 'referrals'));
    }

    /**
     * Get User's Balance
     */
    public function balance()
    {
        return response()->json([
            'balance' => Auth::user()->balance,
            'curreny' => 'NGN'
        ], 200);
    }

    /**
     * Get Users's Details
     */
    public function info()
    {
        $user = Auth::user();

        $user->makeHidden([
            'id', 'token', 'pin', 'referrer', 'first_time_funding',
            'created_at', 'updated_at', 'active', 'role', 'permission'
        ]);

        return response()->json(Auth::user(), 200);
    }
}
