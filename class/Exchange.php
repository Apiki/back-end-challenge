<?php

declare (strict_types = 1);

class Exchange
{
	
	public function convertCoin($parametros) 
	{	
		
			$simboloMoeda = array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');

			//pego os parâmetros passados pelo usuário na url
			$amount 	= $parametros[2];	//Parâmetro - Quantodade de moedas
			$from 		= $parametros[3];	//Parâmetro - Moeda de atual
			$to 		= $parametros[4];	//Parâmetro - Moeda de desejada
			$rate 		= $parametros[5];	//Parâmetro - Taxa da moeda desejada

			$amount	 = str_replace('.', '', $amount);
			$amount	 = str_replace(',', '.', $amount);
			$rate	 = str_replace('.', '', $rate);
			$rate	 = str_replace(',', '.', $rate);

		    $valorConvertido = round($amount * $rate,2) ;                    
		    $resultado = json_encode(['valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda[$to]]);

		    return $resultado;
	}
}


