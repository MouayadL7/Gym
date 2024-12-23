<?php

namespace App\Helpers;

class ResponseHelper
{
    /**
     * Send a success response.
     *
     * @param mixed $result
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendResponse($result)
    {
        $response = [
            'status' => 'success',
            'data'    => $result,
        ];

        return response()->json($response, 200);
    }

    /**
     * Send an error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function sendError($error, $code = 404, $errorMessages = [])
    {
        $response = [
            'status' => 'failure',
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
