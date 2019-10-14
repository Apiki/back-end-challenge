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
 * @author   Bryan França <bryanfranca2@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

header('Content-type: text/plain; charset=utf-8');

include ('valores.php');

$conversao = new Valores();

if (isset($_SERVER['PATH_INFO']))
{	
	$url =  $_SERVER['PATH_INFO'];
	$parametros = explode("/", $url);

	// Valida a quantidade de parametros

	if(sizeof($parametros) == 5)
	{
		$conversao->setAmount($parametros[1]);
		$conversao->setFrom($parametros[2]);
		$conversao->setTo($parametros[3]);
		$conversao->setRate($parametros[4]);

		$count = 0;
		$errvar6 = "";

		// Valida os parametros passados

		if ($conversao->validarInt($parametros[1]) === false)
		{
			$errvar1 =  "Quantidade a converter é inválida ou zero {amount}";
			$count ++;
			$errvar6 = $errvar6. " - " .$errvar1;
		}

		if ($conversao->validarMoeda($parametros[2]) === false)
		{
			$errvar2= "Moeda a converter diferente de (BRL,USD,EUR) {from}";
			$count ++;
			$errvar6 = $errvar6. " - " .$errvar2;
		}

		if ($conversao->validarMoeda($parametros[3]) === false)
		{
			$errvar3= "Moeda de conversão diferente de (BRL,USD,EUR) {to}";
			$count ++;
			$errvar6 = $errvar6. " - " .$errvar3;
		}

		if ($conversao->validarInt($parametros[4]) === false)
		{
			$errvar4= "Taxa de conversão é inválida ou zero {rate}";
			$count ++;
			$errvar6 = $errvar6. " - " .$errvar4;
		}

	 	// Caso tenha algum parametro inválido, retorna o 400, caso não, retorna o 200
		if ($count > 0)
		{
			$errvar5 = "Verifique os parametros";
			$conversao->resposta(400,$errvar5,$errvar6);
			 
		}

		else
		{

		$quant = $conversao->getAmount();
		$taxa = $conversao->getRate();

		$valorConvertido = ($quant * $taxa);
		$simbolo = $conversao->tpMoeda($conversao->getTo());

		
		$conversao->resposta(200,$valorConvertido,$simbolo);
		}


	}
	else
	{
		$err1 = "Requisição Inválida";
		$err2 = "Verifique a quantidade de argumentos {amount}/{from}/{to}/{rate}";
		$conversao->resposta(400,$err1,$err2);
	}
}

else
{
	$err1 = "Requisição Inválida";
	$err2 = "Verifique a quantidade de argumentos {amount}/{from}/{to}/{rate}";
	$conversao->resposta(400,$err1,$err2);
}













