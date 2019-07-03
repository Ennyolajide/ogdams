<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function index(){
        return Str::random(8).rand(1,100).Str::random(2);
    }
}
