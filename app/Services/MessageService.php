<?php


namespace App\Services;


use GuzzleHttp\Client;

class MessageService
{
    private $messageCost = 7;
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

        return $this->client->request('POST', $url, ['body' => json_encode($body)]);
    }

    public function checkMessageCountAvailable()
    {
        $url = 'payment/points';

        $response = $this->client->request('GET', $url);
        $body = json_decode($response->getBody()->getContents());
        $points = $body->data;
        return (int)floor($points / $this->messageCost);
    }

}
