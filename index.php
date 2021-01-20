<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

// BOOTSTRAP

use CoffeeCode\Router\Router;

/**
 * API ROUTES
 * index.
 */
$route = new Router("http://localhost:8000", ':');
$route->namespace('App\Controllers\Api');

//exchange
$route->group('/exchange');
$route->get('/', 'Exchange:index');
$route->get('/{amount}/{from}/{to}/{rate}', 'Exchange:index');

// ROUTE
$route->dispatch();

// ERROR REDIRECT
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(400);

    echo json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

ob_end_flush();
