<?php

namespace App\Http\Controllers;

//7020898261

use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;

class RingoElectricityBillController extends RingoApiController
{

    public function validateEletcricityMeter()
    {
        return $this->billValidation(request()->productId, request()->meterId);
    }

    public function validateTvSmartCard()
    {
        return $this->billValidation(request()->productId, request()->cardNo);
    }

    public function test()
    {
        //return $this->billValidation(2, 23300065960);
        //return $this->billValidation(8, 7020898261);
        return $this->dstvInternetMiscTopup(7, 1, 7029664775, 2000);


        /* $product = RingoProduct::find(7);
        return $product->productList->find(1);
        $subProduct = RingoSubProductList::find(100);
        $option = $subProduct ? $subProduct->code : request()->amount;
        return $option;
        return $this->dstvInternetMiscTopup('Tv', request()->productId, request()->smartCardNumber, request()->option); */
    }


    /**
     * Perform a Dstv/Internet/Misc Topup
     */
    public function dstvInternetMiscTopup($productId, $subProductId, $meterId, $amount)
    {
        $body = json_encode(['meter' => (string)$meterId]);
        $product = RingoProduct::find($productId);
        $options = $product->product_list ?
            $this->getSubProductOptions($product, $subProductId) : $this->validateAmount($product, $amount);
        $endPoint = $options ? 'billpay/' . $product->service_id . '/' . $product->product_id . '/' . $options['option'] : false;
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
        $amount = is_numeric($amount) ? $amount : false;
        $amount = ($amount && $amount % $product->step == 0) ? $amount : false;
        $amount = ($amount && $amount >= $product->min_amount && $amount <= $product->max_amount) ? $amount : false;

        return $amount ? ['option' => $amount, 'charge' => ($product->charges + $amount)] : false;
    }
}

class BillController extends RingoElectricityBillController
{

    public function index()
    {
        $products = RingoProduct::whereStatus(true)->get();
        return view('dashboard.bills.index ', compact('products'));
    }

    public function electricity(RingoProduct $product)
    {
        return view('dashboard.bills.electricity.index', compact('product'));
    }

    public function tv(RingoProduct $product)
    {
        $productList = $product->productList;
        return view('dashboard.bills.tv.index', compact('product', 'productList'));
    }
}
