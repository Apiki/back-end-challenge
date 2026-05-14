<?php

/**
 * Back-end Challenge.
 *
 * PHP version 8.1
 *
 * Este arquivo é o entry point usado nos testes automatizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Exchange;
use App\ExchangeException;
use App\Request;
use App\Response;

try {
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
