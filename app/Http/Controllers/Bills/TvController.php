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
        //check is the request is an api request
        $isApi = request()->wantsJson();

        //validate request()
        $this->validate(request(), [
            'cardNo' => 'required|string|min:10|max:18',
            'email' => $isApi ? 'sometimes|string' : 'required|email',
            'package' => $isApi ? 'sometimes|string' : 'required|json',
            'owner' => $isApi ? 'sometimes|string' : 'required|string',
            'phone' => $isApi ? 'sometimes|string' : 'required|string|min:10|max:13',

            'packageId' => $isApi ? ['required', 'numeric', function ($attribute, $value, $fail) {
                in_array($value, RingoSubProductList::whereService('Tv')->pluck('id')->toArray()) ? false : $fail('Invalid Tv :attribute');
            }] : 'sometimes|numeric',
        ]);

        $uniqueReference = $this->getUniqueReference();

        $status = $this->processTvTopup($uniqueReference);

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
    protected function processTvTopup($uniqueReference)
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

            $status = $subProduct ? $this->topup($subProduct, $details, $uniqueReference) : false;
            $status ? $this->notify($this->tvTopupNotification($details, $uniqueReference, $this->responseObject)) : false;

            return $status;
        }
    }
}
