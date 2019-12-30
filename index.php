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
 * @author   Josimar Pinto Camilo josimarifmg@gmail.com
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');

// http://localhost:8000/exchange/10/BRL/USD/4.50

$url = ltrim( parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_PATH ) , '/' );

$rota = explode( '/' , $url );

$resp = json_encode(array ("valorConvertido" => 0, "simboloMoeda" => ""), JSON_PRETTY_PRINT); //resposta nula inicialmente

$moeda['BRL'] = 'R$';
$moeda['USD'] = '$';
$moeda['EUR'] = '€';

if(count($rota) < 5 or count($rota) > 5) // url inválida, sem from, to, rate, maior etc
{
	http_response_code(400);
	print_r($resp);
	exit();
}

if(! is_numeric($rota[1]) or (is_numeric($rota[1]) and $rota[1] < 0)) // valor invalido, inexistente ou negativo
{
	http_response_code(400);
	print_r($resp);
	exit();
}

if(! isset($moeda[$rota[2]]) or ! isset($moeda[$rota[3]]) ) //invalid from e to
{
	http_response_code(400);
	print_r($resp);
	exit();
}

if(! is_numeric($rota[4]) or (is_numeric($rota[4]) and $rota[4] < 0)) //invalido rate ou negativo
{
	http_response_code(400);
	print_r($resp);
	exit();
}

// if (($rota[2] == 'USD' and $rota[3] == 'EUR') or ($rota[2] == 'EUR' and $rota[3] == 'USD'))//invalido de dolar para euro e vice versa
// {
// 	http_response_code(400);
// 	print_r($resp);
// 	exit();
// }

$resp = json_encode(array ("valorConvertido" => $rota[1] * $rota[4], "simboloMoeda" => $moeda[$rota[3]]), JSON_PRETTY_PRINT); //json formatado

print_r($resp);

