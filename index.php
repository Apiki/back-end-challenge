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
 * @author   Yuri Coelho <yuricelho197@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

header('Content-type: application/json');
require_once 'conversor.php';

$tmp = explode('/', $_SERVER['REQUEST_URI']); 

if (count($tmp) == 6){ 
	$valor = $tmp[2];  #Ignora as posições 0 e 1 do array que são, respectivamente, " "  e  "exchange"
	$de = strtoupper($tmp[3]);
	$para = strtoupper($tmp[4]);
	$cotacao = $tmp[5];

	$conv = new conversor();
	$resposta = $conv->converter($valor, $de, $para, $cotacao);
}
else{
   	http_response_code(400);
   	$resposta = "Verifique os parâmetros de entrada";
}
echo json_encode($resposta, JSON_UNESCAPED_UNICODE);