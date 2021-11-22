<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class ApiController extends Controller
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $code = 200)
    {
        $response = [
            'success' => true,
            'status' => $code
        ];
        $response['result'] = $result;
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $code)
    {
        $response = [
            'success' => false,
            'status' => $code
        ];
        $response['result']['message'] = $message;

        return response()->json($response, 200);
    }
}
