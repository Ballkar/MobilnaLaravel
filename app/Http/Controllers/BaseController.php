<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{

    /**
     * @param $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse($data, string $message, int $code = 200)
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }

    /**
     * @param string $error
     * @param int $code
     * @param array $additionalMessage
     * @return JsonResponse
     */
    public function sendError(string $error, int $code, array $additionalMessage = [])
    {
        $response = [
            'code' => $code,
            'message' => $error,
            'errors' => $additionalMessage
        ];


        return response()->json($response, $code);
    }
}
