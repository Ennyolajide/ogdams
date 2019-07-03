<?php

namespace App\Http\Controllers\Bills;

use App\Bill;
use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function GuzzleHttp\json_decode;
use Illuminate\Support\Facades\Auth;

class TvController extends BillController
{
    /**
     * validate Tv SmartCard
     */
    public function validateSmartCard()
    {
        return $this->billValidation(request()->productId, request()->cardNo);
    }

    /**
     * Topup Tv( Dstv|Gotv|Startime)
     */
    public function store()
    {
        //validate request()
        $this->validate(request(), [
            'email' => 'required|email',
            'owner' => 'required|string',
            'package' => 'required|json',
            'phone' => 'required|string|min:10|max:13',
            'cardNo' => 'required|string|min:10|max:18',
        ]);

        $status = $this->processTvTopup();

        $message = $status ? $this->successResponse : $this->failureResponse;

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Tv Topup
     */
    protected function processTvTopup()
    {
        $packageId = json_decode(request()->package, true);

        $packageId = $packageId['id'] ?? $packageId;

        $subProduct = RingoSubProductList::find($packageId);

        $details['cardNo'] = $subProduct ? request()->cardNo : false;

        $details['type'] = $subProduct ? $subProduct->name . ' Topup' : false;

        $details['amount'] = $subProduct ? $subProduct->selling_price : false;

        $details['product'] = $subProduct ? ucwords(strtolower($subProduct->product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($subProduct && (Auth::user()->balance >= $subProduct->selling_price)) {

            $status = $subProduct ? $this->topup($subProduct, $details) : false;

            $status ? $this->notify($this->tvTopupNotification($details)) : false;

            return $status;
        }
    }
}
