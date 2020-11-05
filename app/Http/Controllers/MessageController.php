<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MessageController extends Controller
{

    public function send($message, $to)
    {
        $client = new Client();
        $url = 'https://justsend.pl/api/rest/v2/message/send';
        $type = 'PRO';
        $from = 'Mobilna Kosmetyczka';
        $doubleEncode = false;


        $request = new Request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'App-Key' => env('MESSAGE_KEY')
            ],
            'body' => [
                'message' => $message,
                'to' => $to,
                'bulkVariant' => $type,
                "doubleEncode" => $doubleEncode,
                'from' => $from
            ]
        ]);

        $promise = $client->sendAsync($request)->then(function ($response) {
            echo 'I completed! ' . $response->getBody();
        });

        $promise->wait();

    }
}
