<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use App\Http\Controllers\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class PasswordResetController extends Controller
{
    //
    public function index()
    {
        return view('users/reset');
    }

    public function reset()
    {
        $this->validate(request(), [
            'email' => 'required|email|min:5|max:50'
        ]);

        $user = User::whereEmail(request()->email)->whereActive(true)->first();

        if ($user) {
            $lastReset = $user->passwordResets
                ->where('created_at', '>=', Carbon::now()
                    ->subDay(1))->first();
            if (!$lastReset) {
                $token = md5(Str::random(8) . uniqid());

                $status = PasswordReset::create([
                    'token' => $token, 'email' => $user->email,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $link = route('user.password.reset.verify', ['email' => $user->email, 'token' => $token]);

                try {
                    $status ? Mail::to($user->email)->send(new PasswordResetMail($user->name, $link)) : false;
                } catch (\Exception $e) {
                    Log::info('Cound not send Password Reset Email');
                }

                $response = 'Password Reset Instruction has been sent to your mail';
            } else {
                $status = true;
                $response = 'Password Reset will be available after 24hours from the last successful reset time';
            }
        } else {
            $status = false;
            $response = 'Email Does not Exist';
        }

        return back()->withResponse($response)->withStatus($status);
    }

    public function verify($email, $token)
    {

        $reset = !empty($token) || !empty($email)
            ? PasswordReset::whereEmail($email)
            ->whereToken($token)
            ->where('created_at', '>=', Carbon::now()->subDay(1))
            ->get()->last()
            : false;

        return $reset
            ? view('users.password', compact('email', 'token'))
            : redirect()->route('user.password.reset')
            ->withResponse('Invalid / Expired Password Reset Link')->withStatus(false);
    }


    /**
     * Edit/Change user passwordd
     */
    public function change($email, $token)
    {
        //validate Request
        $this->validate(request(), [
            'password' => 'required|string|min:5|max:20|confirmed'
        ]);

        $reset = !empty($token) || !empty($email)
            ? PasswordReset::whereEmail($email)
            ->whereToken($token)
            ->where('created_at', '>=', Carbon::now()->subDay(1))
            ->get()->last()
            : false;

        if ($reset) {
            $status = $reset->user->update(['password' => bcrypt(request()->password)]);
            $status ? $reset->update(['token' => uniqid() . uniqid()]) : false;
            $message = $status ? 'Password updated successfully' : 'Password update failed';
        } else {
            $message = 'Invalid user email or token or user is already active.';
        }

        $response = ['status' => $status ?? false, 'message' => $message];

        return view('users.password', compact('email', 'token', 'response'));
    }
}
