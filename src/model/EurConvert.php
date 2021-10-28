<?php

namespace App\model;


use App\components\Helpers;

class EurConvert {

	public $simbol = "€";
	private $total = 0.00;

	public function convToBrl($eur, $rate) {
		Helpers::validateAmount($eur, $rate);
		$this->total += ($eur * $rate);
		return $this->total;
	}

}