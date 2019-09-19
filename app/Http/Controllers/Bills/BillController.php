<?php

namespace App\Http\Controllers\Bills;

use App\Bill;
use App\RingoProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;

class BillController extends RingoController
{
    protected $responseObject;
    protected $successResponse = ' Topup successful';
    protected $apiErrorResponse = 'Top failed, Pls try again later';
    protected $failureResponse = 'Insuffient balance, Pls fund your account';

    /**
     * Store Tv Payments
     */
    protected function storeTopup($details, $status, $responseObject)
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
    protected function topup($product, $details, $uniqueReference, $isElectricity = false)
    {
        $this->responseObject = $isElectricity ? $this->electricityTopup($product) : $this->tvInternetMiscTopup($product);
        $status = $this->responseObject ? $this->debitWallet($details['amount']) : false;
        $this->failureResponse = $this->responseObject ? $this->failureResponse : $product->name . ' ' . $this->apiErrorResponse;
        $tvTopupRecord = $this->storeTopup($details, $status, $this->responseObject);
        $this->recordTransaction($tvTopupRecord, $uniqueReference, $status, $status, false, true);

        return $status;
    }

    /**
     * Amount validation base of the product min and max amount | numeric | step
     * @return true or false on failed validation
     */
    /*     public function amountError($product, $amount)
    {
        if (!$product) {
            return false;
        }
        $minValueError = $amount >= $product->min_amount ? false : true; //check min value error
        $maxValueError = $amount <= $product->max_amount ? false : true; //check max value error
        $stepValueError = $amount % $product->step == 0 ? false : true;  //check step value error

        $stepErrorMessage = $stepValueError ? 'Amount can only be a multiple of ' . $product->step : false;

        $minMaxErrorMessage = $minValueError || $maxValueError ?
            'Amount cannot be less than ₦' . $product->min_amount . ' or greater than ₦' . $product->max_amount : false;

        return $minMaxErrorMessage ? $minMaxErrorMessage : $stepErrorMessage;
    } */


    /**
     * Bill Validator api
     */
    public function billValidator()
    {
        $this->validate(request(), ['serviceId' => 'numeric|min:1', 'meterId' => 'numeric|min:8']);

        return $this->billValidation(request()->serviceId, request()->meterId);
    }

    /**
     * Get the list of api services
     */
    public function servicesList()
    {
        $services = RingoProduct::all()->mapToGroups(function ($item, $key) {
            return [
                $item['service'] => [
                    'name' => $item['name'],
                    'service_id' => $item['id']
                ]
            ];
        });
        return response()->json($services, 200);
    }

    /**
     * Get the a bill service list
     */
    public function serviceList($service)
    {
        $list = RingoProduct::whereService(ucfirst($service))->whereStatus(1)->get();
        $list->makeHidden(['product_id', 'service', 'product_list', 'logo', 'route', 'multichoice']);

        return response()->json($list, ($list->count() ? 200 : 404));
    }
}
