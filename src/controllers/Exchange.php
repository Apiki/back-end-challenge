<?php

namespace App\controllers;


use App\core\Controller;
use App\model\BrlConvert;


class Exchange extends Controller {
	public function index() {
		echo "Hello World";
	}

	public function brl_to_usd($amount) {
		if(!is_array($amount)){
			$this->status(400);
			$erro = [
				'msg' 	=> 'Router not found',
				'code' 	=> 404
			];
			$erro = \json_encode($erro);
			throw new \Exception($erro);
		}

		$brl = new BrlConvert;
		$total = $brl->convToUsd($amount['for'], $amount['to']);
		$msg = [
			'valorConvertido' 	=> $total,
			'simbolo' 					=> $brl->simbol
		];
		$this->status(200);
		echo \json_encode($msg);
		die;
	}

}