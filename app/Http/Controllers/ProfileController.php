<?php

namespace App\Http\Controllers;

use App\User;
use App\Bank;
use App\Charge;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends PaystackController
{
    protected $failureResponse = 'Password update fail';
    protected $errorResponse = 'Inavlid current password';
    protected $successResponse = 'Password updated successfully';

    /**
     * Shows
     */
    public function profileIndex()
    {
        $banks = $this->bankList()->data; //get the list of all available banks
        $myBanks = Bank::where('user_id', Auth::user()->id)->get();  //get User's bank List
        $addBankCharges = Charge::whereService('addbank')->first()->amount;
        $messages = Message::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.profile.index', compact('banks', 'myBanks', 'addBankCharges', 'messages'));
    }

    /**
     * Edit/Change user passwordd
     */
    public function editPassword(Request $request)
    {
        $this->validate(request(), ['password' => 'required|confirmed', 'currentPassword' => 'required']);
        $isValidCurrentPassword = password_verify($request->currentPassword, Auth::user()->password); //Verify current password
        $status = $isValidCurrentPassword ? User::find(Auth::user()->id)->update(['password' => bcrypt($request->password)]) : false; //update password
        $message = $status ? $this->successResponse : ($isValidCurrentPassword ? $this->failureResponse : $this->errorResponse);

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function uploadAvatar()
    { }
}
