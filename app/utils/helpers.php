<?php

namespace App\utils;

use Symfony\Component\HttpFoundation\JsonResponse;

function responseJson($status, $message, $data = null): JsonResponse
{

    $response = [
        "status" => $status,
        "message" => $message,
        "data" => $data
    ];

    return response()->json($response);
}
