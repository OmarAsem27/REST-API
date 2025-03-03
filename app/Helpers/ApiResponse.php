<?php

namespace App\Helpers;


class ApiResponse
{
    static function sendResponse($code = 201, $msg = null, $data = null)
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return response()->json($response, $code);
    }
}
