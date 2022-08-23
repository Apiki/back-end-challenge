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
 * @author   Leonardo Mazza de Souza <desenvolvedormazza@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */


use App\CurrencyConvertion;

require __DIR__ . '/vendor/autoload.php';

$allowedCurrency    = ['BRL' => 'R$','USD' => '$','EUR' => '€'];
$urlParams = array_filter(explode('/', $_SERVER['REQUEST_URI']));

$amount     = !empty($urlParams[2]) ? (double) $urlParams[2] : NULL;
$rate       = !empty($urlParams[5]) ? (double) $urlParams[5] : NULL;

$from           = !empty($urlParams[3]) ? $urlParams[3] : NULL;
$to             = !empty($urlParams[4]) ? $urlParams[4] : '';
$exchangeUrl    = !empty($urlParams[1]) && $urlParams[1] == 'exchange';

$object = new CurrencyConvertion;
$object->convert($amount, $from, $to, $rate, $allowedCurrency, $exchangeUrl);
echo json_encode($object);
