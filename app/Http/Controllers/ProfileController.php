<?php

namespace App\Http\Controllers;

use App\Bvn;
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
        $charges = Charge::all();
        $user = User::find(Auth::user()->id);
        $myBanks = $user->banks;  //get User's bank List
        $user->bvnDetails ?? Bvn::create(['user_id' => Auth::user()->id]);
        $banks = $this->bankList()->data; //get the list of all available banks
        $messages = Message::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('dashboard.profile.index', compact('banks', 'myBanks','messages','charges'));
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

        return request()->wantsJson() ?
            response()->json(['status' => $status, 'message' => $message ], 201) : back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Edit/Change user Phone Number
     */
    public function editProfile()
    {
        $this->validate(request(), [
            'name' => 'required|string|min:5|max:25',
            'phone' => 'required|string|nullable|min:11|max:13'
        ]);
        $status = Auth::user()->update(['number' => request()->phone, 'name' => request()->name]);
        $message = $status ? 'Operation Successful' : 'Operation failed';

        return back()->withNotification($this->clientNotify($message, $status));
    }

    public function uploadAvatar()
    { }
}
