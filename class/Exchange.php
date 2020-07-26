<?php

declare (strict_types = 1);

class Exchange
{
	
	public function convertCoin($parametros) 
	{	
		
		$simboloMoeda = array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');

		//pego os parâmetros passados pelo usuário na url
		$amount 	= $parametros[2];	//Parâmetro - Quantodade de moedas
		$to 		= $parametros[4];	//Parâmetro - Moeda de desejada
		$rate 		= $parametros[5];	//Parâmetro - Taxa da moeda desejada

	  	$valorConvertido = (string)(float)$amount * (string)(float)$rate;
	  	$valorConvertido = (string)(float)$valorConvertido;
		
		if ($valorConvertido >0) {
			
			$resultado = json_encode(['valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda[$to]]);

		} else {	

		        $erro = 400;
		        header_remove();
		        http_response_code($erro);
		        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
		        header('Content-Type: application/json');
		        header("HTTP/1.1 "."400 Bad Request");
		        
		        $resultado =  json_encode("400 Bad Request", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		}

		return $resultado;
	}
}


