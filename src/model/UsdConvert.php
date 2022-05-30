<?php

namespace App\model;


use App\components\Helpers;

class UsdConvert {

	public $simbol = "$";
	private $total = 0.00;

	public function convToBrl($usd, $rate) {
		Helpers::validateAmount($usd, $rate);
		$this->total += ($usd * $rate);
		return $this->total;
	}

}