<?php

namespace App\Http\Controllers\Bills;

use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MiscController extends BillController
{

    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';
    protected $successResponse = ' Operation successful Pls check Your inbox for your pin(s)';


    /**
     * get the list of Misc services
     */
    public function serviceList()
    {
        $services = $this->serviceProductList('Misc')->map(function ($item) {
            return [
                'productId' =>  $item['id'],
                'name' => $item['name'] == "N700 PIN" ? 'WAEC ' . $item['name'] : $item['name'],
                'service' =>  $item['service'], 'price' => $item->selling_price, 'currency' => 'NGN'
            ];
        });

        return response()->json($services, 200);
    }


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
            'productId' => $isApi ? ['required', 'numeric', function ($attribute, $value, $fail) {
                in_array($value, RingoSubProductList::whereService('Misc')->pluck('id')->toArray()) ? false : $fail('Invalid Misc :attribute');
            }] : 'sometimes|numeric',
        ]);

        $uniqueReference = $this->getUniqueReference();
        $status = $this->processMiscTopup($uniqueReference);
        $message = $status ? $this->successResponse : $this->failureResponse;

        if ($isApi) {
            $pinBased = $status ? $this->responseObject->original->pin_based : false;
            return response()->json([
                'status' => $status, 'message' => $message,
                'reference' => $status ? $uniqueReference : null,
                'target' => $status ? $this->responseObject->original->target : '',
                'topup_amount' => $pinBased ? $this->responseObject->original->topup_amount : '',
                'operator' => $pinBased ? $this->responseObject->original->operator_name : '',
                'pins' => $status ? $this->responseObject->original->pins : '',
            ], 200);
        }

        return back()->withNotification($this->clientNotify($message, $status));
    }

    /**
     * Proces Tv Topup
     */
    protected function processMiscTopup($uniqueReference)
    {
        $packageId = request()->wantsJson() ? request()->productId : json_decode(request()->package, true);

        $packageId = request()->wantsJson() ? $packageId : $packageId['id'] ?? $packageId;

        $subProduct = RingoSubProductList::find($packageId);

        $details['email'] = $subProduct ? request()->email : false;

        $details['type'] = $subProduct ? $subProduct->name : false;

        $details['amount'] = $subProduct ? $subProduct->selling_price : false;

        $details['product'] = $subProduct ? ucwords(strtolower($subProduct->product->name))  : false;

        $this->successResponse = $details['product'] . $this->successResponse;

        if ($subProduct && (Auth::user()->balance >= $subProduct->selling_price)) {

            $status = $subProduct ? $this->topup($subProduct, $details, $uniqueReference, 'misc') : false;

            $status ? $this->notify($this->miscTopupNotification($details, $uniqueReference, $this->responseObject)) : false;

            return $status;
        }
    }
}
