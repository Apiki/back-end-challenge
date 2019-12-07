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
 * @author   Alan Brum <alanbrum311@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

header('Content-type: application/json');
require __DIR__ .'/CurrencyConverter.php';

$searchUrl = explode('/', $_SERVER['REQUEST_URI']); 

if (count($searchUrl) == 6){  
	$howmuch = $searchUrl[2]; #Obter a quantidade da moeda de entrada
	$from = strtoupper($searchUrl[3]); #Obter qual moeda de entrada.
	$to = strtoupper($searchUrl[4]); #Obter moeda de saída
	$rate = $searchUrl[5]; #Obter a cotação da moeda

	$conv = new currencyconverter();
	$answer = $conv->converter($howmuch, $from, $to, $rate);
}
else{
   	http_response_code(400);
   	$answer = "Modelo de URL diferente do esperado";
}
echo json_encode($answer, JSON_UNESCAPED_UNICODE);

