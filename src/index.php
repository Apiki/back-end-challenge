<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Gustavo Dias <gustavodiasdsc@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

use App\ExchangeController;
use App\Response;

require __DIR__ . '/../vendor/autoload.php';


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri !== '/' && file_exists(__DIR__ . '/../../' . $uri)) {
    Response::routeNotFound();
    return;
}

$segments = explode('/', trim($uri, '/')); 


if (!(count($segments) === 5 && $segments[0] === 'exchange')) {
    Response::routeNotFound();
    return;
}

ExchangeController::convert($segments);






