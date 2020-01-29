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
 * @author   Seu Nome Vitor Prata
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';


require "classes/Exchange.php";

$exchange = new Exchange;

$url = $exchange->getUrl();

if(count($url) < 4) {

    $response = array(
        "Error" => "Está faltando um ou mais dados para a conversão."
    );

    $encoded = json_encode($response, JSON_UNESCAPED_UNICODE);

    echo $encoded;
} else {
    $currency = $exchange->selectCurrency($url);

    $encoded = json_encode($currency, JSON_UNESCAPED_UNICODE);

    echo $encoded;

}
