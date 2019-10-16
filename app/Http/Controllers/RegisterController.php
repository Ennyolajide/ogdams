<?php

namespace App\Http\Controllers;


use App\User;
use Validator;
use App\Mail\Main;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    //


    public function index($referrer = null)
    {
        $app = (object) config('constants.site');
        $referrer = $referrer ? User::where('wallet_id', $referrer)->first() : null;

        return view('users/login', compact('app', 'referrer'));
    }

    public function register()
    {
        $token = md5(uniqid());

        $validator = Validator::make(request()->all(), [
            'referrerId'  => 'sometimes',
            'email'     => 'required|string|email|max:255|unique:users',
            'name'      => 'required|string|min:5|max:75',
            'phone'    => 'required|string|min:11|max:13',
            'password'  => 'required|string|min:5|confirmed',

        ]);
        if ($validator->fails()) {
            return redirect(url()->previous() . '#signup')->withErrors($validator)->withInput();
        }

        User::create([
            'token'         => $token,
            'email'         => request()->email,
            'number'        => request()->phone,
            'name'          => ucwords(request()->name),
            'password'      => Hash::make(request()->password),
            'referrer'      => request()->has('referrerId') ? User::find(request()->referrerId)->id : null,
            'wallet_id'     => strtoupper(Str::random(2)) . rand(1, 10) . strtoupper(Str::random(1)) . rand(1, 100) . strtoupper(Str::random(2)),
        ]);

        $link = url('users/verify/' . request()->email . '/' . $token);

        $subject = 'Email Verification';
        $message = 'Please complete your registration by verifing your email, ';
        $message .= 'follow link below to verify your email ' . $link;

        Mail::to(request()->email)->send(new Main($message, $subject, $link));

        $response = 'Registration Successful, please check your email inbox or email spam ';
        $response .= 'folder to verify email and complete registration.';

        return redirect(url()->previous() . '#signup')->with('response', $response);
    }
}
