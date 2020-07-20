<?php declare(strict_types = 1);

 class Exchange
 {
 	
    public function convertCoin($parametros) 
    {	
 		
 
        $amount 	= $parametros[0];	//Parâmetro - Quantodade de moedas
        $from 		= $parametros[1];	//Parâmetro - Moeda de atual
        $to 		= $parametros[2];	//Parâmetro - Moeda de desejada
        $rate 		= $parametros[3];	//Parâmetro - Taxa da moeda desejada
 
        $amount		= str_replace(',', '.',  $amount);
        $rate	 	= str_replace(',', '.',  $rate);
 
        $valorConvertido =	round($amount * $rate,2) ;
 		
        if ($to == 'BRL') { $simboloMoeda 	 = 'R$'; }
        if ($to == 'USD') { $simboloMoeda 	 = '$'; }
        if ($to == 'EUR') { $simboloMoeda 	 = '€'; }
 		    
        $resultado		 =array("valorConvertido"=>$valorConvertido,"simboloMoeda"=>$simboloMoeda);
 
        return $resultado;
    }
 }
