<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class BaseApiController extends Controller
{
    public function sendSuccess($data, $message="", $responseCode)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $responseCode);
    }

    public function sendError($error, $errorMessages = [], $responseCode)
    {
        $response = [
            'error' => 'ERROR!',
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $responseCode);
    }

}
