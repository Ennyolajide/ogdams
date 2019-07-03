<?php

namespace App\Http\Controllers\Bills;

use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MiscController extends BillController
{
    protected $successResponse = ' pin purchase successful';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Topup Tv( Dstv|Gotv|Startime)
     */
    public function store()
    {

        //validate request()
        $this->validate(request(), [
            'email' => 'required|email',
            'package' => 'required|json',
            'phone' => 'required|string|min:10|max:13',
        ]);

        $status = $this->processMiscTopup();

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Tv Topup
     */
    protected function processMiscTopup()
    {
        $packageId = json_decode(request()->package, true);

        $packageId = $packageId['id'] ?? $packageId;

        $subProduct = RingoSubProductList::find($packageId);

        $details['email'] = $subProduct ? request()->email : false;

        $details['type'] = $subProduct ? $subProduct->name : false;

        $details['amount'] = $subProduct ? $subProduct->selling_price : false;

        $details['product'] = $subProduct ? ucwords(strtolower($subProduct->product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($subProduct && (Auth::user()->balance >= $subProduct->selling_price)) {

            $status = $subProduct ? $this->topup($subProduct, $details) : false;

            $status ? $this->notify($this->miscTopupNotification($details)) : false;

            return $status;
        }
    }
}
