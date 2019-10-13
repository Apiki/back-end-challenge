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
header('Content-type: application/json');

require_once 'conversor.php';

if(isset($_SERVER['PATH_INFO'])){
    $tmp = explode('/', $_SERVER['PATH_INFO']); 

	if (count($tmp) == 5){
    	$valor = $tmp[1];
	    $de = strtoupper($tmp[2]);
    	$para = strtoupper($tmp[3]);
  	 	$cotacao = $tmp[4];

    	$conv = new conversor();
    	$resposta = $conv->converter($valor, $de, $para, $cotacao);
	}
	else{
    	http_response_code(400);
    	$resposta = "Verifique os parâmetros de entrada";
	}
	echo json_encode($resposta, JSON_UNESCAPED_UNICODE);
}
else{
	http_response_code(400);
	echo json_encode("Informe os parâmetros de entrada", JSON_UNESCAPED_UNICODE);
}
?>