<?php

namespace App\Http\Controllers\Control;

use App\Charge;
use App\RingoProduct;
use App\BulkSmsConfig;
use App\RingoSubProductList;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class BillsController extends ModController
{
    protected $failureResponse = 'Operation Failed';
    protected $successResponse = 'Operation Successful';

    public function show(RingoProduct $product)
    {
        return view('control.bills', compact('product'));
    }

    public function edit(RingoSubProductList $subProduct)
    {
        //validate request
        $this->validate(request(), ['amount' => 'required|numeric|min:1']);
        $status = $subProduct->update(['selling_price' => request()->amount]);
        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }
}
