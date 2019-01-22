<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function __contruct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){

        return view('');
    }

    public function login(){

        $request = request()->validate([
            'email' => 'required|exist:users|email}min:5|max:40',
            'password' => 'required|min:5'
            ]);

        //create user date for authentication
        $userData = [
            'email' => request()->email,
            'password' =>request()->password
        ];

        if(Auth::attempt($userData)){
            return redirect('dashboard.home');
        }else{
            request()->session()->flash('failed','Invalid Password');
            return back();
        }


    }

    public function logout(){

    }
}
