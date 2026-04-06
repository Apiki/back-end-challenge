<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * @category Challenge
 * @package  Back-end
 * @author   Eduardo Lopes <eduardo.frlopes@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Exchange\ExchangeRequestFactory;
use App\Exchange\ExchangeService;
use App\Http\BadRequestException;
use App\Http\JsonResponse;

$factory = new ExchangeRequestFactory();
$service = new ExchangeService();

try {
    $request = $factory->fromUri($_SERVER['REQUEST_URI'] ?? '/');
    $response = new JsonResponse($service->convert($request));
} catch (BadRequestException $exception) {
    $response = new JsonResponse(['error' => 'Invalid request'], 400);
}

$response->send();
