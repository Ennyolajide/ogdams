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
        $testimonials = Testimonial::all();
        $app = (object) config('constants.site');
        $dataPlans = DataPlan::all()->groupBy('network_id');

        return view('index', compact('testimonials', 'app', 'dataPlans'));
    }
}


//$networks = DataPlan::orderBy('network_id', 'asc')->distinct()->get(['network', 'network_id']);

        //return $dataPlans->toArray();
