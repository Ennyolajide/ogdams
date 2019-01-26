<?php

namespace App\Http\Controllers;

use App\Mail\Main;
use App\User;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function verify($email, $token)
    {
        $user = User::where('email', $email)->where('token', $token)->where('active', false)->first();
        if ($user) {
            $user->update(['active' => 1, 'token' => null]);

            $subject = 'Registration successful';
            $message = 'You have successfully verified your email, you can now login at' .url('users/login');

            Mail::to($user->email)->send(new Main($message, $subject));

            $response = 'Email verification successful, you can now login';
            return redirect('users/login')->with('success',$response);

        } else {

            $response = 'Invalid user email or token or user is already active.';
            return redirect('users/login')->with('response',$response);

        }
    }
}
