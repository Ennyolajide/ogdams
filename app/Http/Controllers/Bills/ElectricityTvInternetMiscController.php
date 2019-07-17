<?php

namespace App\Http\Controllers\Bills;

use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ElectricityTvInternetMiscController extends RingoController
{

    /**
     * Perform a Dstv/Internet/Misc Topup
     */
    public function tvInternetMiscTopup($subProduct)
    {
        return true;
        $meterId = json_encode(['meter' => (string) request()->cardNo]);

        $endPoint = 'billpay/dstv/' . $subProduct->product->product_id . '/' . $subProduct->code;

        $response = $endPoint ? $this->ringo($endPoint, 'post', $meterId) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    /**
     * Perform Electricty Topup
     */
    public function electricityTopup($product)
    {
        $body = json_encode([
            'prepaid' => request()->prepaid,
            'product_id' => $product->product_id,
            'meter' => (string) request()->cardNo,
            'denomination' => (string) request()->amount,
        ]);

        $endPoint = 'billpay/electricity/' . request()->cardNo;

        $response = $endPoint ? $this->ringo($endPoint, 'post', $body) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    /**
     * get the sub-productoptions : use to build array to be used in dstvInternetMiscTopup
     * return array -> subproduct code && charge (amount to be charged)
     */
    public function getSubProductOptions($product, $subProductId)
    {
        $subProduct = $product->productList->find($subProductId);

        return $subProduct ? ['option' => $subProduct->code, 'charge' => $subProduct->selling_price] : false;
    }

    /**
     * Amount validation base of the product min and max amount | numeric | step
     * @return amount or false on failed validation
     */
    public function validateAmount($product, $amount)
    {
        $amount = ($amount && $amount % $product->step == 0) ? $amount : false;
        $amount = ($amount && $amount >= $product->min_amount && $amount <= $product->max_amount) ? $amount : false;

        return $amount ? ['option' => $amount, 'charge' => ($product->charges + $amount)] : false;
    }
}
