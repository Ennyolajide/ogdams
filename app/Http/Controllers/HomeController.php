<?php

namespace App\Http\Controllers;

use App\DataPlan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $dataPlans = DataPlan::all()->groupBy('network_id');
        //$networks = DataPlan::orderBy('network_id', 'asc')->distinct()->get(['network', 'network_id']);

        //return $dataPlans->toArray();
        return view('index', compact('dataPlans'));
    }
}
