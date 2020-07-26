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


require_once 'class/Exchange.php';

class REST_API_APIKI
{

	function processaRequest()
	{

			$paramentrosUrl = explode('/', $_SERVER['REQUEST_URI']);
			$moedas = array('USD', 'BRL', 'EUR');

	    if (substr_count($_SERVER['REQUEST_URI'], '/') !== 5) {

	        $erro = 400;
	        header_remove();
	        http_response_code($erro);
	        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
	        header('Content-Type: application/json');
	        header("HTTP/1.1 "."400 Bad Request");
	        
	        echo json_encode("400 Bad Request", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

	    } else {			

			//pego os parâmetros passados pelo usuário na url
			$from 		= $paramentrosUrl[3];	//Parâmetro - Moeda de atual
			$to 		= $paramentrosUrl[4];	//Parâmetro - Moeda de desejada
		    $classe 	= 'Exchange';	//Classe - Contém a função responsável pela conversão da moeda
		    $metodo 	= 'convertCoin';//Função - Convenverte a moeda
		    //$parametros = $paramentrosUrl;

		    //valido os parâmetros passados pelo usuário na url		    
			if (  in_array($from, $moedas) && in_array($to, $moedas) && is_numeric($paramentrosUrl[2])  && is_numeric($paramentrosUrl[5]) && $paramentrosUrl[2] >0 && is_numeric($paramentrosUrl[5]) >0)
			{ 

				//chamo a classe Exchange
			    if (class_exists($classe)) {

			    	if (method_exists($classe, $metodo)) {

			    		$retorno = call_user_func_array(array(new $classe, $metodo), array($paramentrosUrl));
			    		return $retorno;
			    	}
			    }
				//%%%%%%%%347

			} else {

		        $erro = 400;
		        header_remove();
		        http_response_code($erro);
		        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
		        header('Content-Type: application/json');
		        header("HTTP/1.1 "."400 Bad Request");
		        
		        echo json_encode("400 Bad Request", JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			}			
		}
	}
}

if (isset($_REQUEST)) {

	$open = new REST_API_APIKI;
	echo($open->processaRequest($_REQUEST));

}
