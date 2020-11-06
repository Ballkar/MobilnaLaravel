<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MessageController extends Controller
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://justsend.pl/api/rest/v2/',
            'headers' => [
                'content-type' => 'application/json',
                'App-Key' => env('MESSAGE_KEY')
            ]
        ]);

    }

    public function send($message, $from, $to, $doubleEncode = false, $type='PRO')
    {
        $url = 'message/send';
        $body = [
            'message' => $message,
            'to' => $to,
            'bulkVariant' => $type,
            "doubleEncode" => $doubleEncode,
            'from' => $from
        ];


        $response = $this->client->request('POST', $url, ['body' => json_encode($body)]);
//        var_dump(json_decode($response->getBody()->getContents()));
    }
}
