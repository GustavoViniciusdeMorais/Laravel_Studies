<?php

namespace GustavoMorais\Article\Infrastructure\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function success(
        $data,
        $status = "success",
        $message = "Operation executed successfully"
    ) {
        return new JsonResponse([
           "status" => $status,
           "message" => $message,
           "data" => $data
        ], 200);
    }

    public function error(
        $data = false,
        $status = "error",
        $message = "Something went wrong"
    ) {
        return new JsonResponse([
           "status" => $status,
           "message" => $message,
           "data" => $data
        ], 500);
    }
}
