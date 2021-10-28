<?php

namespace App\controllers;


use App\core\Controller;
use App\model\BrlConvert;
use App\components\Helpers;


class Exchange extends Controller {
	public function index() {
		echo "Hello World";
	}

	public function brl_to_usd($amount) {
		if(!is_array($amount)){
			$msg = Helpers::msgJson('Problemas ao processar a requisição', 500);
			throw new \Exception($msg);
		}

		$brl = new BrlConvert;
		$total = $brl->convToUsd($amount['for'], $amount['to']);
		$msg = Helpers::msgApi($total,$brl->simbol);
		$this->status(200);
		echo $msg;
		die;
	}

}