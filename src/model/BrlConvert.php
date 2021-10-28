<?php

namespace App\model;


class BrlConvert {

	private $usd = 5.54;
	private $eur = 6.42;
	public $simbol = "r$";
	private $total = 0.00;

	public function convToUsd($rs, $usd) {
		$this->total += ($rs/($usd * $this->usd));
		return $this->total;
	}

	public function convToEur($rs, $eur) {
		$this->total += ($rs/($eur * $this->eur));
		return $this->total;
	}

}