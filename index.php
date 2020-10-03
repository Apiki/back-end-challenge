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
 * @author   Gustavo Bonetti <gustavobonetti8@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

use App\Controllers\ExchangeController;

require __DIR__ . '/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// all of our endpoints start with /exchange
// everything else results in a 404 Not Found
if ($uri[1] !== 'exchange') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$amount = isset($uri[2]) ? $uri[2] : null;
$from = isset($uri[3]) ? $uri[3] : null;
$to = isset($uri[4]) ? $uri[4] : null;
$rate = isset($uri[5]) ? $uri[5] : null;

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new ExchangeController($requestMethod, $amount, $from, $to, $rate);
echo $controller->processRequest();