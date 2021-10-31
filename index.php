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
 * @author   Yoelvis Alfredo Jimenez <@alfredojry>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

include __DIR__ . '/src/exchange.php';

$endpoint = 'exchange';
$params = array_filter(explode('/', $_SERVER['REQUEST_URI']));

// valida único endpoint acetado
if ($params[1] == $endpoint) {
    $controllerExchange = new Exchange();
    $controllerExchange->processRequest();
} else {
    header("HTTP/1.1 404 Not Found");
}
