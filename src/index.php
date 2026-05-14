<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Exchange;
use App\ExchangeException;
use App\Request;
use App\Response;

try {
    $method = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');
    if ($method !== 'GET') {
        header('Allow: GET');
        Response::error('Method not allowed.', 405);
        return;
    }

    $uri   = (string) ($_SERVER['REQUEST_URI'] ?? '/');
    $input = (new Request($uri))->parse();

    Response::json((new Exchange($input))->toArray());
} catch (ExchangeException $e) {
    $code = $e->getCode() > 0 ? $e->getCode() : 400;
    Response::error($e->getMessage(), $code);
} catch (\JsonException $e) {
    Response::error('Failed to encode response.', 500);
} catch (\Throwable $e) {
    Response::error('Internal server error.', 500);
}
