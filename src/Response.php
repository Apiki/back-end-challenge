<?php

declare(strict_types=1);

namespace App;

use JsonException;

/**
 * Handles HTTP response output. JSON-only.
 */
final class Response
{
    /**
     * Sends a JSON response.
     *
     * JSON_THROW_ON_ERROR makes encoding failures observable instead of
     * silently producing an empty/false body.
     *
     * @param array<string, mixed> $data
     * @throws JsonException if the data cannot be encoded as JSON.
     */
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Sends a JSON error response.
     *
     * @throws JsonException if the message cannot be encoded.
     */
    public static function error(string $message, int $status = 400): void
    {
        self::json(['error' => $message], $status);
    }
}
