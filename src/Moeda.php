<?php
namespace Apiki\Framework;

Class Moeda{


  public function SimboloMoeda($moeda){

		switch ($moeda) {
			case "BRL":{
				return 'R$';
				break;
			}
			case "USD":{
				return '$';
				break;
			}
			case "EUR":{
				return '€';
				break;
			}

		}
	}

	public function converterValor($amount, $rate){

		$resultado = $amount * $rate;
 		if($resultado < 0){
			$resultado = '';
		}

		return $resultado;

	}
}
