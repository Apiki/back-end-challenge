<?php
declare(strict_types=1);

namespace App\Http;

class JsonResponse
{
    public static function send(array $data, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}