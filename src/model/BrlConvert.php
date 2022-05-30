<?php

namespace App\model;


use App\components\Helpers;

class BrlConvert {

	public $simbol = "r$";
	private $total = 0.00;

	public function convToUsd($amount, $rate) {
		Helpers::validateAmount($amount, $rate);
		$this->total += ($amount/$rate);
		return $this->total;
	}

	public function convToEur($amount, $rate) {
		Helpers::validateAmount($amount, $rate);
		$this->total += ($amount/$rate);
		return $this->total;
	}

}