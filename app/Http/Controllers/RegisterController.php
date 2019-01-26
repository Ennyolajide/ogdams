<?php

namespace App\Http\Controllers;


use App\Mail\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\User;

class RegisterController extends Controller
{
    //


    public function index()
    {
        return view('users/register');
    }

    public function register()
    {

        $token = md5(uniqid());

        $this->validate(request(), [
            'name'      => 'required|string|max:50',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:5|confirmed'

        ]);

        User::create([
            'name'       => ucwords(request()->name),
            'email'      => request()->email,
            'password'   => Hash::make(request()->password),
            'token'      => $token
        ]);

        $link = url('users/verify/'.request()->email.'/'.$token);

        $subject = 'Email Verification';
        $message = 'Please complete your registration by verifing your email, ';
        $message.= 'follow link below to verify your email '.$link;

        Mail::to(request()->email)->send(new Main($message, $subject, $link));

        $response = 'Registration Successful, please check your email inbox or email spam ';
        $response.= 'folder to verify email and complete registration.';

        return back()->with('response',$response);
    }
}
