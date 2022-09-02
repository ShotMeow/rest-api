<?php

namespace App\Services;

class ResponseService
{
    public static function success(mixed $data, int $code = 200)
    {
        return response(["data" => $data], $code);
    }

    public static function error(mixed $message, int $code)
    {
        return response(["error" => [
            "code" => $code,
            "message" => $message
        ]], $code);
    }
}
