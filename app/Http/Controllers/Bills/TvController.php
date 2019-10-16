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
    public function validateSmartCard($provider)
    {
        $validation = 'required|string|min:8|max:13';
        $this->validate(request(), ['cardNo' => $validation]);
        return $this->tvSmartCardValidation($provider, request()->cardNo);
    }

    /*
    * get the list of Misc services
     */
    public function tvProviders()
    {
        $providers = $this->service('Tv')->map(function ($item) {
            $item['serviceId'] = $item['id'];
            return $item;
        })->makeHidden([
            'id', 'product_id', 'service', 'logo', 'route',
            'service_id', 'min_amount', 'max_amount', 'step', 'multichoice'
        ]);

        return response()->json($providers, 200);
    }

    /**
     * get the list of Misc services
     */
    public function tvPackages($provider)
    {
        $packages = RingoSubProductList::whereCategory($provider)
            ->whereStatus(1)->get()->map(function ($item) {
                $item['bouquetId'] = $item['id'];
                $item['provider'] = $item['category'];
                $item['price'] = $item['selling_price'];
                $item['currency'] = 'NGN';
                return $item;
            })->makeHidden([
                'id', 'code', 'created_at', 'updated_at', 'route',
                'ringo_price', 'selling_price', 'ringo_product_id', 'category', 'status'
            ]);
        return response()->json($packages, 200);
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
            'bouquetId' => $isApi ? ['required', 'numeric', function ($attribute, $value, $fail) {
                in_array($value, RingoSubProductList::whereService('Tv')->pluck('id')->toArray()) ? false : $fail('Invalid Tv :attribute');
            }] : 'sometimes|numeric',
        ]);

        $uniqueReference = $this->getUniqueReference();
        $status = $this->processTvTopup($uniqueReference);
        $message = $status ? $this->successResponse : $this->failureResponse;

        ///Api response
        if ($isApi) {
            return response()->json([
                'status' => $status, 'message' => $message,
                'reference' => $status ? $uniqueReference : null
            ], 200);
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Tv Topup
     */
    protected function processTvTopup($uniqueReference)
    {
        $packageId = request()->wantsJson() ? request()->bouquetId : json_decode(request()->package, true);

        $packageId = request()->wantsJson() ? $packageId : $packageId['id'] ?? $packageId;

        $subProduct = RingoSubProductList::find($packageId);

        $details['cardNo'] = $subProduct ? request()->cardNo : false;

        $details['type'] = $subProduct ? $subProduct->name . ' Topup' : false;

        $details['amount'] = $subProduct ? $subProduct->selling_price : false;

        $details['product'] = $subProduct ? ucwords(strtolower($subProduct->product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($subProduct && (Auth::user()->balance >= $subProduct->selling_price)) {

            $status = $subProduct ? $this->topup($subProduct, $details, $uniqueReference, 'tv') : false;

            $status ? $this->notify($this->tvTopupNotification($details, $uniqueReference, $this->responseObject)) : false;

            return $status;
        }
    }
}
