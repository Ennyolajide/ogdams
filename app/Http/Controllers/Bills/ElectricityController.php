<?php

namespace App\Http\Controllers\Bills;

use App\Bill;
use App\Charge;
use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ElectricityController extends BillController
{


    protected $invalidResponse = 'Invalid serviceId';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';
    protected $successResponse = ' Operation successful Pls check Your inbox for your pin(s)';


    /**
     * Validate meter
     */
    public function validateMeter($serviceId)
    {
        $this->validate(request(), [
            'serviceId' => 'numeric|min:1', 'meterId' => 'string|min:8'
        ]);
        return $this->electricityValidation($serviceId, request()->meterId);
    }

    /**
     * Discos
     */
    public function discos()
    {
        $discos = $this->service('Electricity')->makeHidden([
            'product_id', 'service', 'logo', 'route', 'multichoice'
        ])->map(function ($item) {
            $item['serviceId'] = $item['id'];
            return $item;
        });
        return response()->json($discos, 200);
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
        $this->charges = Charge::whereService('electricity')->first()->amount;
        $status = $this->processElectricityTopup($uniqueReference);
        $message = $status ? $this->successResponse : $this->failureResponse;

        if ($isApi) {
            return response()->json([
                'status' => $status, 'message' => $message,
                'reference' => $status ? $uniqueReference : null,
                'target' => $status ? $this->responseObject->original->target : '',
                'topup_amount' => $status ? $this->responseObject->original->topup_amount : '',
                'disco' => $status ? $this->responseObject->original->operator_name : '',
                'pin' => $status ? $this->responseObject->original->pin_code : '',
                'disco_message' => $status ? $this->responseObject->original->pin_option1 : '',
            ], 200);
        }

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

            $status = $product ? $this->topup($product, $details, $uniqueReference, 'electricity') : false;

            $status ? $this->notify($this->electricityTopupNotification($details, $uniqueReference, $this->responseObject, $this->charges)) : false;

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
