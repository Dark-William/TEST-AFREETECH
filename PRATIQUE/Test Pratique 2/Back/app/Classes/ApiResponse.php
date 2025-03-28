<?php

namespace App\Classes;


class ApiResponse{
    public static function ApiResponse($data, $error, $message = null, $status = 200){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'error' => $error
        ], $status);
    }
}