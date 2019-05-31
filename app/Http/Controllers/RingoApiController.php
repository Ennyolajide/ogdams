<?php

namespace App\Http\Controllers;

use App\Token;
use App\RingoProduct;


class RingoApiController extends TransactionController
{
    public function ringoToken()
    {
        $storage = new Token();
        $storage->whereName('Ringo')->get()->count() ? '' : $this->storeToken();
        $tokenObject = $storage->whereName('Ringo')->first();

        return $tokenObject->expires > date('Y-m-d H:i:s', time()) ? $tokenObject->token : $this->storeToken('update');
    }

    protected function getRingoToken()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->post('https://sales.ringo.ng/api/auth', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => '{"username":"' . env('RINGO_USERNAME') . '","password":"' . env('RINGO_PASSWORD') . '"}',
        ]);

        return json_decode($request->getBody()) ?? false;
    }

    protected function storeToken($action = null)
    {
        return is_null($action) ? $this->insertToken($this->getRingoToken()) : $this->upadateToken($this->getRingoToken());
    }

    protected function upadateToken($ringo)
    {
        Token::whereName('Ringo')->first()->update([
            'name' => 'Ringo',
            'token' => $ringo->token,
            'expires' => date('Y-m-d H:i:s', strtotime($ringo->expires)),
        ]);

        return $ringo->token;
    }

    protected function insertToken($ringo)
    {
        Token::create([
            'name' => 'Ringo',
            'token' => $ringo->token,
            'expires' => date('Y-m-d H:i:s', strtotime($ringo->expires)),
        ]);
    }

    public function headers()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->ringoToken(),
        ];
    }

    public function ringo(string $route, string $type = null, $body = '{}')
    {
        $type = is_null($type) ? 'get' : 'post';
        $endPoint = 'https://sales.ringo.ng/api/' . $route;
        $client = new \GuzzleHttp\Client(['http_errors' => false]);
        $request = $client->$type($endPoint, ['headers' => $this->headers(), 'body' => $body,]);
        $status = ($request->getStatusCode() == '200' || $request->getStatusCode() == '201') ? true : false;
        return $status ? json_decode($request->getBody()->getContents()) : false;
    }

    /**
     * Validate the bill (get meter|smartCard details )
     * return @ json object
     */
    public function billValidation($productId, $meterId)
    {
        $productId = is_numeric($productId) && is_numeric($meterId) ? $productId : false;
        $product = RingoProduct::whereId($productId)->whereValidation(true)->first();
        $endPoint = $product ? 'billpay/' . $product->service_id . '/' . $product->product_id . '/validate' : false;
        $response = $endPoint ? $this->ringo($endPoint, 'post', json_encode(['meter' => (string)$meterId])) : false;
        $response ? $response->response = true : false;

        return  response()->json($response ? $response : ['response' => false]);
    }
}
