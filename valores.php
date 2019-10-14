<?php

class Valores {

private $amount;
private $from;
private $to;
private $rate;


//Amount
public function getAmount() 
{
   return $this->amount;
}
 
public function setAmount($amount)
{
   $this->amount= $amount;
}

//From
public function getFrom() 
{
   return $this->from;
}
 
public function setFrom($from)
{
   $this->from= $from;
}

//To
public function getTo() 
{
   return $this->to;
}
 
public function setTo($to)
{
   $this->to= $to;
}

//Rate
public function getRate() 
{
   return $this->rate;
}
 
public function setRate($rate)
{
   $this->rate= $rate;
}


// Valida se os valores de taxa e quantidade passados são numéricos e maiores que 0
public function validarInt($num)
{
	if (is_numeric($num) && $num > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

//Valida se a moeda atual e a moeda de conversão estão entree as disponíveis
public function validarMoeda($moed)
{
	$moeda = array("BRL", "EUR", "USD");

	foreach ($moeda as $val) {
	    if (strpos($moed, $val) !== FALSE) 
	    {
	        return true;
	    }
	}
	return false;
}

public function resposta($status,$msg1,$msg2)
{
	header("HTTP/1.1 ".$status);

	if ($status == 200)
	{
		$resposta['valorConvertido']=$msg1;
		$resposta['simboloMoeda']=$msg2;
		
		$json_response = json_encode($resposta,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

		echo $json_response;
	}

	if ($status == 400)
	{
		$resposta['erro']=$msg1;
		$resposta['campos']=$msg2;
		
		$json_response = json_encode($resposta,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );

		echo $json_response;
	}
}

//Retorna o símbolo da moeda
public function tpMoeda($simbolo)
{
	if ($simbolo == "BRL")
	{
		return "R$";
	}

	if ($simbolo == "EUR")
	{

		return "€";
	}

		if ($simbolo == "USD")
	{
		return "$";
	}

}

}