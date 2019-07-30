<?php

namespace App\Http\Controllers\Bills;

use App\Token;
use App\RingoProduct;
use App\RingoSubProductList;
use App\Http\Controllers\Controller;


class RingoController extends RingoTokenController
{

    /**
     * Perform a Dstv/Internet/Misc Topup
     */
    public function tvInternetMiscTopup($subProduct)
    {
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

        $enPoint = 'billpay/electricity/' . request()->cardNo;

        $response = $endPoint ? $this->ringo($endPoint, 'post', $body) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    /**
     * Validate the bill (get meter|smartCard details )
     * return @ json object
     */
    public function billValidation($productId, $meterId)
    {
        $body = json_encode(['meter' => (string) $meterId]);

        $productId = is_numeric($productId) && is_numeric($meterId) ? $productId : false;

        $product = RingoProduct::whereId($productId)->whereValidation(true)->first();

        $query = $product ? $product->service_id . '/' . $product->product_id  : false;

        $response = $query ? $this->ringo('billpay/' . $query . '/validate', 'post', $body) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    /**
     * Consume a Ringo Api
     */
    protected function ringo(string $route, string $type = null, $body = '{}')
    {
        $type = is_null($type) ? 'get' : 'post';

        $endPoint = \config('constants.url.ringo') . $route;

        $client = new \GuzzleHttp\Client(['http_errors' => false]);

        $request = $client->$type($endPoint, ['headers' => $this->headers(), 'body' => $body]);

        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return $status ? json_decode($request->getBody()->getContents()) : false;
    }
}
