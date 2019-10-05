<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as Controller;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

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
     * @param $additionalMessage
     * @return JsonResponse
     */
    public function sendError(string $error, int $code, $additionalMessage = null)
    {
        $response = [
            'message' => $error,
        ];

        if ($additionalMessage !== null) {
            $response['errors'] = $additionalMessage;
        }


        return response()->json($response, $code);
    }
}
