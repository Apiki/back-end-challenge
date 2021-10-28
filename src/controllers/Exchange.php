<?php

namespace App\controllers;


use App\core\Controller;
use App\model\BrlConvert;
use App\components\Helpers;
use App\model\UsdConvert;
use App\model\EurConvert;


class Exchange extends Controller {
	public function index() {
		$this->status(200);
		$msg = Helpers::msgJson('Bem vindo a conversão de moedas', 200);
		echo $msg;
		die;
	}

	public function brl_to_usd($datas) {
		if(!is_array($datas)){
			$this->status(500);
			$msg = Helpers::msgJson('Problemas ao processar a requisição', 500);
			throw new \Exception($msg);
		}

		$brl = new BrlConvert;
		$total = $brl->convToUsd($datas['amount'], $datas['rate']);
		$msg = Helpers::msgApi($total,$brl->simbol);
		$this->status(200);
		echo $msg;
		die;
	}

	public function brl_to_eur($datas) {
		if(!is_array($datas)){
			$this->status(500);
			$msg = Helpers::msgJson('Problemas ao processar a requisição', 500);
			throw new \Exception($msg);
		}

		$brl = new BrlConvert;
		$total = $brl->convToEur($datas['amount'], $datas['rate']);
		$msg = Helpers::msgApi($total,$brl->simbol);
		$this->status(200);
		echo $msg;
		die;
	}

	public function usd_to_brl($datas) {
		if(!is_array($datas)){
			$this->status(500);
			$msg = Helpers::msgJson('Problemas ao processar a requisição', 500);
			throw new \Exception($msg);
		}

		$usd = new UsdConvert;
		$total = $usd->convToBrl($datas['amount'], $datas['rate']);
		$msg = Helpers::msgApi($total,$usd->simbol);
		$this->status(200);
		echo $msg;
		die;
	}

	public function eur_to_brl($datas) {
		if(!is_array($datas)){
			$this->status(500);
			$msg = Helpers::msgJson('Problemas ao processar a requisição', 500);
			throw new \Exception($msg);
		}

		$eur = new EurConvert;
		$total = $eur->convToBrl($datas['amount'], $datas['rate']);
		$msg = Helpers::msgApi($total,$eur->simbol);
		$this->status(200);
		echo $msg;
		die;
	}

}