<?php

namespace App\Http\Controllers\Control;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class UsersController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function usersIndex()
    {
        return view('control.users');
    }

    public function searchUsers()
    {
        $this->validate(request(), ['user' => 'required|string|min:3']);

        return User::where('name', 'like', '%' . request()->user . '%')->get();
    }

    public function viewUser(User $user)
    {
        return view('control.user', compact('user'));
    }

    /**
     * Block|Active users
     */
    public function setUserStatus(User $user)
    {
        //validate request
        $this->validate(request(), ['action' => 'required|boolean']);
        $status = $user->update(['active' => request()->action]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Alter User's balance
     */
    public function alterUserBalance(User $user)
    {
        //validate request
        $this->validate(request(), [
            'amount' => 'required|numeric',
            'dedit' => 'sometimes|boolean',
            'credit' => 'sometimes|boolean',
        ]);
        $credited = request()->has('credit') ? $this->creditUserWallet($user->id, request()->amount) : false;
        $debited = request()->has('debit') ? $this->debitUserWallet($user->id, request()->amount) : false;
        $status = $credited ^ $debited ? true : false;
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function edit(RingoSubProductList $subProduct)
    {
        //validate request
        $this->validate(request(), ['amount' => 'required|numeric|min:1']);
        $status = $subProduct->update(['selling_price' => request()->amount]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
