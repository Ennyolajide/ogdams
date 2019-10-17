<?php

namespace App\Http\Controllers\Bills;

use App\Token;
use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class RingoController extends RingoTokenController
{

    /**
     * Perform a Tv Topup
     */
    public function tvTopup($subProduct)
    {
        $meterId = json_encode(['meter' => (string) request()->cardNo]);

        $endPoint = 'billpay/dstv/' . $subProduct->product->product_id . '/' . $subProduct->code;

        $response = $endPoint ? $this->ringo($endPoint, 'post', $meterId) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    /**
     * Perform a Dstv/Internet/Misc Topup
     */
    public function internetTopup($subProduct)
    {
        $meterId = json_encode(['meter' => (string) request()->cardNo]);

        $endPoint = 'billpay/internet/' . $subProduct->product->product_id . '/' . $subProduct->code;

        $response = $endPoint ? $this->ringo($endPoint, 'post', $meterId) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    /**
     * Perform a Dstv/Internet/Misc Topup
     */
    public function miscTopup($subProduct)
    {
        $meterId = json_encode(['meter' => (string) request()->cardNo]);

        $endPoint = 'billpay/misc/' . $subProduct->product->product_id . '/' . $subProduct->code;

        $response = $endPoint ? $this->ringo($endPoint, 'post', $meterId) : false;

        Log::info('Refernce : Misc -> Response Object' . $this->responseObject);

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }


    /**
     * Perform Electricty Topup
     */
    public function electricityTopup($product)
    {
        $body = json_encode([
            'prepaid' => true,
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
     * Validate the bill (get meter|smartCard details )
     * return @ json object
     */
    public function electricityValidation($productId, $meterId)
    {
        $body = json_encode(['meter' => (string) $meterId]);

        $productId = is_numeric($productId) && is_numeric($meterId) ? $productId : false;

        $product = RingoProduct::whereId($productId)->whereValidation(true)->first();

        $query = $product ? $product->service_id . '/' . $product->product_id  : false;

        $response = $query ? $this->ringo('billpay/' . $query . '/validate', 'post', $body) : false;

        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }

    public function tvSmartCardValidation($provider, $meterId)
    {

        $body = json_encode(['meter' => (string) $meterId]);

        $product = RingoProduct::whereName(strtoupper($provider))->whereValidation(true)->first();

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

        $client = new \GuzzleHttp\Client([
            'debug' => false,
            'http_errors' => false, 'timeout' => 30, 'connect_timeout' => 30
        ]);
        $request = $client->$type($endPoint, ['headers' => $this->headers(), 'body' => $body]);

        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;

        return $status ? json_decode($request->getBody()->getContents()) : false;
    }
}
