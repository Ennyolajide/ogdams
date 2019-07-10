<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    //


    public function __contruct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {

        return view('users/login');
    }

    public function login()
    {
        $inactiveResponse = 'Account Inactive, please check your email inbox or email spam ';
        $inactiveResponse .= 'folder to verify email and complete registration.';

        $this->validate(request(), [
            'email'     => 'required|exists:users|email|min:5|max:40',
            'password'  => 'required|min:5',
        ]);

        //create user date for authentication
        $userData = [
            'email'     => request()->email,
            'password'  => request()->password,
            'active'    => true
        ];



        if (Auth::attempt($userData, request()->has('remember'))) {
            $route = Auth::user()->role == 'admin' ? '/control' : '/dashboard';
            return redirect($route);
        } else {
            $user = User::where('email', request()->email)->first();

            $response = $user->active ? 'Invalid Username/Password' : $inactiveResponse;
            return back()->with('response', $response);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('user.login'));
    }
}
