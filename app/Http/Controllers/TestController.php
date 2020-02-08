<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(){
        return config('constants.hostedSims.apiToken') ? 'true' : 'false';
    }
}
