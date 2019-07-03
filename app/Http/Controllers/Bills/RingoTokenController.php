<?php

namespace App\Http\Controllers\Bills;

use App\Token;
use App\Http\Controllers\TransactionController;

class RingoTokenController extends TransactionController
{

    /**
     * Get Ringo TOken
     */
    protected function ringoToken()
    {
        $storage = new Token();
        $storage->whereName('Ringo')->get()->count() ? '' : $this->storeToken();
        $tokenObject = $storage->whereName('Ringo')->first();

        return $tokenObject->expires > date('Y-m-d H:i:s', time()) ? $tokenObject->token : $this->storeToken('update');
    }

    /**
     * Retrieve Ringo Token
     */
    protected function getRingoToken()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->post(\config('constants.url.ringo') . 'auth', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => '{"username":"' . env('RINGO_USERNAME') . '","password":"' . env('RINGO_PASSWORD') . '"}',
        ]);

        return json_decode($request->getBody()) ?? false;
    }

    /**
     * Store Ringo Token in db
     */
    protected function storeToken($action = null)
    {
        return is_null($action) ? $this->insertToken($this->getRingoToken()) : $this->updateToken($this->getRingoToken());
    }

    /**
     * Update Ringo Token
     */
    protected function updateToken($ringo)
    {
        Token::whereName('Ringo')->first()->update([
            'name' => 'Ringo', 'token' => $ringo->token,
            'expires' => date('Y-m-d H:i:s', strtotime($ringo->expires)),
        ]);

        return $ringo->token;
    }

    /**
     * Insert Ringo Token
     */
    protected function insertToken($ringo)
    {
        Token::create([
            'name' => 'Ringo', 'token' => $ringo->token,
            'expires' => date('Y-m-d H:i:s', strtotime($ringo->expires)),
        ]);
    }

    /**
     * Headers for Ringo Api
     */
    protected function headers()
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->ringoToken(),
        ];
    }
}
