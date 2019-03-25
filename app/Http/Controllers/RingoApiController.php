<?php

namespace App\Http\Controllers;

class RingoApiController extends Controller
{
    public function index()
    {


        $url = 'https://jsonplaceholder.typicode.com/posts';
        $client = new \GuzzleHttp\Client();
        $request = $client->post($url,
            [ 'title' => 'foo', 'body' => 'bar', 'userId' => 1 ]
        );

        return $request->getBody();

    }
}
