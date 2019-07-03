<?php

namespace App\Http\Controllers\Bills;

use App\Bill;
use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ElectricityController extends BillController
{

    protected $successResponse = ' Topup successful';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';


    /**
     * Validate meter
     */
    public function validateMeter()
    {
        return $this->billValidation(request()->productId, request()->cardNo);
    }

    /**
     * Store
     */
    public function store()
    {
        //validate request()
        $this->validate(request(), [
            'email' => 'required|email',
            'owner' => 'required|string',
            'amount' => 'required|numeric',
            'packageId' => 'required|numeric',
            'phone' => 'required|string|min:10|max:13',
            'cardNo' => 'required|string|min:10|max:18',
        ]);

        $status = $this->processElectricityTopup();

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Tv Topup
     */
    protected function processElectricityTopup()
    {

        $product = RingoProduct::find(request()->packageId);

        $details['cardNo'] = $product ? request()->cardNo : false;

        $details['type'] = $product ? $product->name . ' Topup' : false;

        $details['amount'] = $product ? request()->amount : false;

        $details['product'] = $product ? ucwords(strtolower($product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($product && (Auth::user()->balance >= request()->amount)) {

            $status = $product ? $this->topup($product, $details, true) : false;

            $status ? $this->notify($this->tvTopupNotification($details)) : false;

            return $status;
        }
    }
}
