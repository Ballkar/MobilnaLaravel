<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ApiFormRequest extends FormRequest
{
    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse([
                'code' => 422,
                'status' => 'error',
                'errors' => $errors
            ], 422);
        }
    }

    public function wantsJson()
    {
        return true;
    }

    public function ajax()
    {
        return true;
    }
}
