<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.2
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Adler Oliveira <adler.deoliveira@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
	declare(strict_types = 1);
	require __DIR__ . '/vendor/autoload.php';


require_once 'API/APIKI/Exchange.php';

class REST_API_APIKI
{


	public function abrir($requisicao) 
	{


		if (isset($_REQUEST)) {

			
			if (substr_count($_SERVER['REQUEST_URI'], '/') >=5) {

			    $dados = explode('/', $requisicao['url']);

			} else {

		    	http_response_code(400);
               	return;
			}


		    $amount 	= $dados[0];	//Parâmetro - Quantodade de moedas
		    $from 		= $dados[1];	//Parâmetro - Moeda de atual
		    $to 		= $dados[2];	//Parâmetro - Moeda de desejada
		    $rate 		= $dados[3];	//Parâmetro - Taxa da moeda desejada

		    $classe 	= 'Exchange';	//Classe - Contém a função responsável pela conversão da moeda
		    $metodo 	= 'convertCoin';//Função - Convenverte a moeda
		    $parametros = array();
		    $parametros = $dados;

		    //valido os parâmetros passados pelo usuário na url		    
			$amount_tmp	 = str_replace('.', '',  $amount);
			$amount_tmp	 = str_replace(',', '',  $amount_tmp);

			$rate_tmp	 = str_replace('.', '',  $rate);
			$rate_tmp	 = str_replace(',', '',  $rate_tmp);

			$moedas 	= array('BRL', 'USD', 'EUR');


		    if (count($dados) !== 4 || $dados[0] == "" || $rate == '' || $amount =='' || $from =='' || $to =='' || !is_numeric($amount_tmp) || !is_numeric($rate_tmp) || !in_array($from, $moedas) || !in_array($from, $moedas)) { 

		    	http_response_code(400);
               	return;
		    }
		    /***********final-validação*************/

		    if (class_exists($classe)) {

		    	if (method_exists($classe, $metodo)) {
		    		$retorno = call_user_func_array(array(new $classe, $metodo), array($parametros));

		    		return json_encode(array($retorno));
		    		
		    	}	
		    }




		}		
	}
}

	echo REST_API_APIKI::abrir($_REQUEST);	
