<?php

namespace App\Http\Controllers;

use App\DataPlan;
use App\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $faq = false;
        $testimonials = Testimonial::get()->unique();
        $dataPlans = DataPlan::all()->groupBy('network_id');

        return view('index', compact('testimonials', 'dataPlans', 'faq'));
    }

    public function faq($faq = true)
    {
        return view('index', compact('faq'));
    }

    public function contact()
    {
        return request()->all();
    }
}
