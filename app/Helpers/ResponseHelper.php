<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success(string $message, $data = null, int $status = 200): JsonResponse
    {
        $response = ['message' => $message];

        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }
}
