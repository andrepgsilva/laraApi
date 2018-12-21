<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class BaseController extends Controller 
{
    /**
     * Send a JSON response for successful result
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $result
        ];

        return response()->json($response, 200);
    }

    /**
     * Send a JSON error response.
     * Return HTTP code 404 as standard: 
     */
    public function sendError($error, $errorMessages = [], $code=404)
    {
        $response = [
            'success' => false,
            'message' => $error
        ];

        if (! $errorMessages) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}