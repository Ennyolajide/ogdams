<?php

namespace App\Http\Controllers\Bills;

use App\Bill;
use App\Charge;
use App\RingoProduct;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;

class BillController extends RingoController
{
    protected $charges = 0;
    protected $responseObject;
    protected $successResponse = ' Topup successful';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';


    /**
     * Store Tv Payments
     */
    protected function storeTopup($details, $status)
    {
        return Bill::create([
            'user_id' => Auth::user()->id, 'amount' => $details['amount'], 'details' => json_encode($details),
            'class' => 'App\Bill', 'type' => $details['type'], 'status' => $status ? 2 : 0, 'product' => $details['product'],
            'responseObject' => json_encode($this->responseObject)
        ]);
    }

    /**
     *  Execute Bill Topup
     */
    protected function topup($product, $details, $uniqueReference, $service = null)
    {
        if ($service === 'tv') {
            $this->responseObject = $this->tvTopup($product);
        } else if ($service === 'misc') {
            $this->responseObject = $this->miscTopup($product);
        } else if ($service === 'internet') {
            $this->responseObject = $this->internetTopup($product);
        } else if ($service === 'electricity') {
            $this->responseObject = $this->electricityTopup($product);
        }
        Log::info('Refernce : ' . $uniqueReference . ' ' . $service . '-> Response Object' . $this->responseObject);
        $status = $this->responseObject ? $this->debitWallet($details['amount'] + $this->charges) : false;
        $this->failureResponse = $this->responseObject ? $this->failureResponse : $product->name . ' ' . $this->apiErrorResponse;
        $topupRecord = $this->storeTopup($details, $status);
        $this->recordTransaction($topupRecord, $uniqueReference, $status, $status, false, true);

        return $status;
    }


    /**
     * Get the list of api services
     */
    public function bills()
    {
        return response()->json(
            RingoProduct::all()->unique('service_id')
                ->mapToGroups(function ($item, $key) {
                    return [
                        'services' => [
                            'name' => $item['service_id'],
                            'service' => $item['service_id']
                        ]
                    ];
                }),
            200
        );
    }

    /**
     * Get options/Subproduct of a service
     */
    public function packages($service, $id)
    {
        return RingoProduct::whereService($service)
            ->whereStatus(1)
            ->whereId($id)
            ->first()->productList ?? [];
    }

    /**
     * Get the a bill service list
     */
    public function service($service)
    {
        return RingoProduct::whereService($service)
            ->whereStatus(1)->get();
    }

    /**
     * Get options/Subproduct of a service
     */
    public function serviceProductList($service)
    {
        return RingoProduct::whereService($service)
            ->whereStatus(1)->first()->productList ?? [];
    }
}
