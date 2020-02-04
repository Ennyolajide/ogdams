<?php

namespace App\Http\Controllers\Bills;

use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InternetController extends BillController
{
    protected $successResponse = ' Topup successful';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Topup Tv( Dstv|Gotv|Startime)
     */
    public function store()
    {
        $isApi = request()->wantsJson();

        $this->validate(request(), [
            'email' => $isApi ? 'sometimes|string' : 'required|email',
            'package' => $isApi ? 'sometimes|string' : 'required|json',
            'phone' => $isApi ? 'sometimes|string' : 'required|string|min:10|max:13',
            'cardNo' => 'required|string|min:10|max:18',

            'packageId' => $isApi ? ['required', 'numeric', function ($attribute, $value, $fail) {
                in_array($value, RingoSubProductList::whereService('Internet')->pluck('id')->toArray()) ? false : $fail('Invalid Internet :attribute');
            }] : 'sometimes|numeric',
        ]);

        $uniqueReference = $this->getUniqueReference();

        /*
        $status = $this->processInternetTopup($uniqueReference);

        $message = $status ? $this->successResponse : $this->failureResponse; */

        //Api response
        if ($isApi) {
            return response()->json([
                'status' => true,
                'message' => 'Try again later',
                'reference' => null,
            ], 200);
        }

        return back()->withNotification($this->clientNotify('Try again later', false));
    }

    /**
     * Proces Tv Topup
     */
    protected function processInternetTopup($uniqueReference)
    {
        $packageId = request()->wantsJson() ? request()->packageId : json_decode(request()->package, true);

        $packageId = request()->wantsJson() ? $packageId : $packageId['id'] ?? $packageId;

        $subProduct = RingoSubProductList::find($packageId);

        $details['cardNo'] = $subProduct ? request()->cardNo : false;

        $details['type'] = $subProduct ? $subProduct->name . ' Topup' : false;

        $details['amount'] = $subProduct ? $subProduct->selling_price : false;

        $details['product'] = $subProduct ? ucwords(strtolower($subProduct->product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($subProduct && (Auth::user()->balance >= $subProduct->selling_price)) {

            $status = $subProduct ? $this->topup($subProduct, $details, $uniqueReference, 'internet') : false;

            $status ? $this->notify($this->tvTopupNotification($details, $uniqueReference, $this->responseObject)) : false;

            return $status;
        }
    }
}
