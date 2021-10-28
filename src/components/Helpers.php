<?php

namespace App\components;


class Helpers{

	/**
	 * Formata o padrão do retorno da mensagem da API.
	 *
	 * @param int|float $total que foi convertido.
	 * @param string $simbol uma string que representa a moeda convertida.
	 * @return json a mensagem da API no formato json.
	*/
	public static function msgApi($total, $simbol) {
		if(!is_string($simbol)){
			throw new \Exception('Parametros informado estão incorreto');
		}
		$msg = [
			'valorConvertido' 	=> $total,
			'simbolo' 	=> $simbol
		];
		return \json_encode($msg);
	}

	/**
	 * Formata as respostas generica da API quando algo não sair como esperado, exemplo, erro.
	 *
	 * @param string $message a mensagem a ser apresentada na resposta.
	 * @param int $code status code http.
	 * @return json a mensagem da API no formato json.
	 */
	public static function msgJson($message, $code) {
		if(!is_string($message) || !is_int($code)){
			throw new \Exception('Parametros informado estão incorreto');
		}
		$msg = [
			'msg' 	=> $message,
			'code' 	=> $code
		];
		return \json_encode($msg);
	}

	/**
	 * Valida se os valores são maiores que zero.
	 *
	 * @param int|float $amount o montante a ser avaliado.
	 * @param int|float $rate a taxa a ser avaliada.
	 * @return void lança um erro a ser retornada na resposta.
	 */
	public static function validateAmount($amount, $rate) {
		if((!is_int((int)$amount) && !is_float((float)$amount)) || ($rate <= 0)){
			$msg = self::msgJson('Parametros informado estão incorreto', 500);
			throw new \Exception($msg);
		}
	}

}