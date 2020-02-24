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
        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->take(10)->latest()->get();
        return view('dashboard.index', compact('transactions'));
    }


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

    /**
     * Get Users's bank List
     */
    public function myBanks()
    {
        $banks = User::find(Auth::user()->id)->banks;
        $banks->makeHidden([
            'user_id', 'status',
            'deleted_at', 'created_at', 'updated_at'
        ]);

        return response()->json($banks, 200);
    }
}
