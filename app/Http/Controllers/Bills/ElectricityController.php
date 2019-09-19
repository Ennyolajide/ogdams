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
    protected $invalidResponse = 'Invalid serviceId';
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
        //check is the request is an api request
        $isApi = request()->wantsJson();

        $this->requestValidation($isApi);

        $uniqueReference = $this->getUniqueReference();

        $status = $this->processElectricityTopup($uniqueReference);

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

        //web response
        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Electricity Topup
     */
    protected function processElectricityTopup($uniqueReference)
    {
        $productId = request()->wantsJson() ? request()->serviceId : request()->packageId;

        $product = RingoProduct::find($productId);

        $details['cardNo'] = $product ? request()->cardNo : false;

        $details['type'] = $product ? $product->name . ' Topup' : false;

        $details['amount'] = $product ? request()->amount : false;

        $details['product'] = $product ? ucwords(strtolower($product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if (Auth::user()->balance >= request()->amount) {

            $status = $product ? $this->topup($product, $details, $uniqueReference, true) : false;

            $status ? $this->notify($this->electricityTopupNotification($details, $uniqueReference)) : false;

            return $status;
        }
        return false;
    }

    protected function requestValidation($isApi)
    {
        //validate these 2 request parameters first
        $this->validate(request(), [
            'cardNo' => 'required|string|min:10|max:18',
            'email' => $isApi ? 'sometimes|email' : 'required|email',
            'owner' => $isApi ? 'sometimes|string' : 'required|string',
            'phone' => $isApi ? 'sometimes|string|min:10|max:13' : 'required|string|min:10|max:13',

            'amount' => ['required', 'numeric', 'min:1000', 'max:50000', function ($attribute, $value, $fail) {
                ($value % 100 == 0) ? false : $fail(':attribute can only be a multiple of 100');
            }],

            'packageId' => !$isApi ? ['required', 'numeric', 'min:1', 'max:5', function ($attribute, $value, $fail) {
                in_array($value, RingoProduct::whereService('Electricity')->pluck('id')->toArray()) ? false : $fail('Invalid electricty :attribute');
            }] : 'sometimes|numeric',

            'serviceId' => $isApi ? ['required', 'numeric', 'min:1', 'max:5', function ($attribute, $value, $fail) {
                in_array($value, RingoProduct::whereService('Electricity')->pluck('id')->toArray()) ? false : $fail('Invalid electricty :attribute');
            }] : 'sometimes|numeric',

        ]);
    }
}
