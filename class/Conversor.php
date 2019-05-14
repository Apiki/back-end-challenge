<?php

class Conversor {

	private $symbol;

	public function convert($value, $type_coin, $to_convert, $quotation){
		if ($type_coin == "Real" && $to_convert == "Dólar"){
			$result = $value / $quotation;
			$this->symbol = "$";
		} else if($type_coin == "Dólar" && $to_convert == "Real"){
			$result = $value * $quotation;
			$this->symbol = "R$";
		} else if($type_coin == "Real" && $to_convert == "Euro"){
			$result = $value / $quotation;
			$this->symbol = "€";
		} else if($type_coin == "Euro" && $to_convert == "Real"){
			$result = $value * $quotation;
			$this->symbol = "R$";

			//Caso os tipos de moedas sejam iguais será alertado uma mensagem de aviso.
		} else if($type_coin == $to_convert){
			return "Para converter é necessário que as moedas sejam diferentes!";
		}

		return $this->getSymbol().number_format($result, 2);
	}

	public function getSymbol(){
		return $this->symbol;
	}

}