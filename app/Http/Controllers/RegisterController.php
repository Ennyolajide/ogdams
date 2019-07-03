<?php

namespace App\Http\Controllers;


use App\User;
use App\Mail\Main;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    //


    public function index()
    {
        $referrerId = false;
        return view('users/register', compact('referrerId'));
    }

    public function show($wallet){
        $referrerId = User::where('wallet_id',$wallet)->first()['wallet_id'] ?? false;

        return view('users/register', compact('referrerId'));
    }

    public function register()
    {

        $token = md5(uniqid());

        $this->validate(request(), [
            'referrerId'  => 'sometimes',
            'name'      => 'required|string|max:50',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:5|confirmed',

        ]);
        return request()->all();

        User::create([
            'token'         => $token,
            'api_token' => Str::random(60),
            'email'         => request()->email,
            'name'          => ucwords(request()->name),
            'referrer'      => request()->referrerId ?? null,
            'password'      => Hash::make(request()->password),
            'wallet_id'     => Str::random(8).rand(1,100).Str::random(2),

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
