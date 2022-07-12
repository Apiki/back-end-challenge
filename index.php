<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Seu Nome <lukas_tf@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$amount = $uri[2];
$from = $uri[3];
$to = $uri[4];
$rate = $uri[5];

$c = count($uri);
$obj = new stdClass();

if ($c != 6 || !is_numeric($amount) || !is_numeric($rate) || $amount < 0 || $rate < 0 ||
($from != "USD" && $from != "BRL" && $from != "EUR") ||
($to != "USD" && $to != "BRL" && $to != "EUR")
) {
    $response = json_encode($obj);
    echo $response;

    return http_response_code(400);
}

$valorConvertido = $amount * $rate;
$simboloMoeda = "$";

if ($to == "USD") $simboloMoeda = "$";
if ($to == "BRL") $simboloMoeda = "R$";
if ($to == "EUR") $simboloMoeda = "€";


$obj->valorConvertido = $valorConvertido;
$obj->simboloMoeda = $simboloMoeda;

$response = json_encode($obj);


echo $response;
return http_response_code(200);