<?php

declare (strict_types = 1);

class Exchange
{
	
	public function convertCoin($parametros) 
	{	
		

		$amount 	= $parametros[0];	//Parâmetro - Quantodade de moedas
		$from 		= $parametros[1];	//Parâmetro - Moeda de atual
		$to 		= $parametros[2];	//Parâmetro - Moeda de desejada
		$rate 		= $parametros[3];	//Parâmetro - Taxa da moeda desejada

		    //valido os parâmetros passados pelo usuário na url		    
		$amount_tmp	 = str_replace('.', '',  $amount);
		$amount_tmp	 = str_replace(',', '',  $amount_tmp);

		$rate_tmp	 = str_replace('.', '',  $rate);
		$rate_tmp	 = str_replace(',', '',  $rate_tmp);

		if (count($parametros) !== 4 || $rate == '' || $amount =='' || $from =='' || $to =='' || !is_numeric($amount_tmp) || !is_numeric($rate_tmp)) { 

            http_response_code(400);
            echo json_encode('');
            return;
		}
		/***********final-validação*************/

		$amount	 = str_replace(',', '.',  $amount);
		$rate	 = str_replace(',', '.',  $rate);

		$valorConvertido =	round($amount * $rate,2) ;
		
		if ($to == 'BRL') { $simboloMoeda 	 = 'R$'; }
		if ($to == 'USD') { $simboloMoeda 	 = '$';  }
		if ($to == 'EUR') { $simboloMoeda 	 = '€';  }
		    
		$resultado		 =array("valorConvertido"=>$valorConvertido,"simboloMoeda"=>$simboloMoeda);

		return $resultado;
	}
}


