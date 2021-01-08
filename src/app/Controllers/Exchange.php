<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Exchange extends BaseController
{

	use ResponseTrait;

	const currencyes = array('BRL', 'EUR', 'USD');

	public function index($amount, $from, $to, $rate)
	{
		if (
			//Valida se o AMOUNT é um número
			(!is_numeric($amount)) ||

			//Valida se o AMOUNT é positivo
			(floatval($amount) * 1 < 0) ||

			//Valida se o FROM está dentro das moedas definidas
			(!in_array($from, self::currencyes, TRUE)) ||

			//Valida se o FROM está dentro das moedas definidas
			(!in_array($to, self::currencyes, TRUE)) ||

			//Valida se o RATE é um número
			(!is_numeric($rate)) ||

			//Valida se o RATE é positivo
			(floatval($rate) * 1 < 0)
		) {
			return $this->setResponseFormat('json')->respond(TRUE, 400);
		} else {
			$valor = floatval($amount * $rate);
			$moeda = '';
			switch ($to) {
				case 'USD':
					$moeda = '$';
					break;
				case 'EUR':
					$moeda = '€';
					break;
				case 'BRL':
					$moeda = 'R$';
					break;
			}
			$retorno = (object) array(
				'valorConvertido' => $valor,
				'simboloMoeda' => $moeda
			);
			return $this->response
				->setJSON($retorno);
		}
	}

	public function erro()
	{
		return $this->setResponseFormat('json')->respond(TRUE, 400);
	}

	//--------------------------------------------------------------------

}
