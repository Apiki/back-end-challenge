<?php
namespace App\Controllers;
use App\Api;
use App\Validator;

class Exchange extends Api {

	public function convertCurrency(array $params): void
	{
		if ($this->isValidParams($params)) {
			$this->successResponse(array(
				'valorConvertido' => $params['amount'] * $params['rate'],
				'simboloMoeda' => $this->getSymbol($params['to']),
			));
		}
	}

	private function isValidParams(array $params): ?bool
	{
		$rules = [
			'amount' => 'required|numeric|positive',
			'from' => 'required|exactAs:BRL,USD,EUR',
			'to' => 'required|exactAs:BRL,USD,EUR',
			'rate' => 'required|numeric|positive'
		];

		$v = new Validator();
		$errors = [];
		foreach ($params as $param => $value) {
			if (isset($rules[$param])) {
				$validateRules = $v->validateRules($rules[$param], $param, $value);
				if (is_array($validateRules)) {
					$errors[$param] = $validateRules;
				}
			}
		}

		if (count($errors) <= 0) {
			return true;
		}

		$this->invalidRouteResponse($errors);
	}

	private function getSymbol(string $currency): ?string
	{
		$symbols = [
			'BRL' => 'R$',
			'EUR' => '€',
			'USD' => '$'
		];

		if (array_key_exists($currency, $symbols)) {
			return $symbols[$currency];
		}

		$this->invalidRouteResponse();
	}
}