<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends DashboardController
{
    //

    public function index()
    {
        return view('dashboard.testimonial.index', compact('testimony'));
    }


    public function store()
    {
        //validation
        $this->validate(request(), ['testimony' => 'required|string|min:50|max:150']);
        $status = Testimonial::create(['testimony' =>  request()->testimony]);
        $message = $status ? 'Operation succesful' : 'Operation failed';

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
