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
 * @author   Guilherme Mateus Costa <gui.costa200897@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
use App\Exchange;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode( '/', $uri );

if ($uri[1] !== 'exchange') {
    header("HTTP/1.1 400 Bad Request");
    $response['body'] = json_encode(array(""));
    print_r($response['body']);
    return;
}

$exchange = new Exchange;

if ($exchange->checkName($uri[3]) === false || $exchange->checkName($uri[4]) === false) {
	header("HTTP/1.1 400 Bad Request");
	$response['body'] = json_encode(array("Moeda invalida"));
    print_r($response['body']);
    return;
}

if ($exchange->checkVal($uri[2]) === false || $exchange->checkVal($uri[5]) === false) {
	header("HTTP/1.1 400 Bad Request");
	$response['body'] = json_encode(array("Valores invalidos"));
    print_r($response['body']);
    return;
}

$symbol = $exchange->getSymbol($uri[4]);
$value = $exchange->getExchange($uri[2], $uri[5]);

header('HTTP/1.1 200 OK');
$response['body'] = json_encode(array('valorConvertido' => $value, 'simboloMoeda' => $symbol));
print_r($response['body']);