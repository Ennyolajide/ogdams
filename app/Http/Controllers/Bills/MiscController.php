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
        //check is the request is an api request
        $isApi = request()->wantsJson();

        //validate request()
        $this->validate(request(), [
            'email' => $isApi ? 'sometimes|string' : 'required|email',
            'package' => $isApi ? 'sometimes|string' : 'required|json',
            'phone' => $isApi ? 'sometimes|string' : 'required|string|min:10|max:13',
            'packageId' => $isApi ? ['required', 'numeric', function ($attribute, $value, $fail) {
                in_array($value, RingoSubProductList::whereService('Misc')->pluck('id')->toArray()) ? false : $fail('Invalid Misc :attribute');
            }] : 'sometimes|numeric',
        ]);

        $uniqueReference = $this->getUniqueReference();

        $status = $this->processMiscTopup($uniqueReference);

        $message = $status ? $this->successResponse : $this->failureResponse;

        ///Api response
        if ($isApi) {
            if (isset($this->responseObject->original['pin_based'])) {
                $responseObject = $this->responseObject->original;
                $pins = $responseObject['pin_based'] ? $responseObject['pins'] : false;
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'pins' =>  $pins ?? [],
                'reference' => $status ? $uniqueReference : null,
            ], 200);
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Tv Topup
     */
    protected function processMiscTopup($uniqueReference)
    {
        $packageId = request()->wantsJson() ? request()->packageId : json_decode(request()->package, true);

        $packageId = request()->wantsJson() ? $packageId : $packageId['id'] ?? $packageId;

        $subProduct = RingoSubProductList::find($packageId);

        $details['email'] = $subProduct ? request()->email : false;

        $details['type'] = $subProduct ? $subProduct->name : false;

        $details['amount'] = $subProduct ? $subProduct->selling_price : false;

        $details['product'] = $subProduct ? ucwords(strtolower($subProduct->product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($subProduct && (Auth::user()->balance >= $subProduct->selling_price)) {

            $status = $subProduct ? $this->topup($subProduct, $details, $uniqueReference) : false;

            $status ? $this->notify($this->miscTopupNotification($details, $uniqueReference, $this->responseObject)) : false;

            return $status;
        }
    }
}
