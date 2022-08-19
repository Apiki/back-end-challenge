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
 * @author   Seu Nome <joseph.s.ru@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$urlParams          = array_filter(explode('/', $_SERVER['REQUEST_URI']));
$allowedCurrency    = ['BRL' => 'R$','USD' => '$','EUR' => '€'];

// Amounts
$amount     = !empty($urlParams[2]) ? (double) $urlParams[2] : null;
$rate       = !empty($urlParams[5]) ? (double) $urlParams[5] : null;

// From To convertion
$from           = !empty($urlParams[3]) ? $urlParams[3] : null;
$to             = !empty($urlParams[4]) ? $urlParams[4] : null;
$exchangeUrl    = !empty($urlParams[1]) && $urlParams[1] == 'exchange' ? true : false;

$object         = new stdClass;

if(empty($amount) || empty($rate) || $amount < 0 || $rate < 0 || 
    empty($from) || empty($to) || empty($exchangeUrl) ||
    array_key_exists($from, $allowedCurrency) === false ||
    array_key_exists($to, $allowedCurrency) === false
){
    echo json_encode($object);
    return http_response_code(400);
}

$object->valorConvertido = $amount * $rate;
$object->simboloMoeda = $allowedCurrency[$to];

echo json_encode($object);
return http_response_code(200);