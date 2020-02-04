<?php

namespace App\Http\Controllers;

use App\User;
use App\Testimonial;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends ReferralController
{
    //

    public function index()
    {
        return view('dashboard.testimonial.index');
    }


    public function store()
    {
        //validation

        $hasTestimony = Auth::user()->testimonials->count();
        $this->validate(request(), ['testimony' => 'required|string|min:30|max:150']);
        $status = $hasTestimony ? true : Testimonial::create([
            'testimony' =>  request()->testimony,
            'user_id' => Auth::user()->id
        ]);
        $message = $status ? 'Operation succesful' : 'Operation failed';

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
