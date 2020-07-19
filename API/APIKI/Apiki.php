<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'Exchange.php';

class REST_API_APIKI
{
	public function abrir($chamar) 
	{

		if (isset($_REQUEST)) {

		    $dados = explode('/', $chamar['url']);

		    $amount 	= $dados[0];	//Parâmetro - Quantodade de moedas
		    $from 		= $dados[1];	//Parâmetro - Moeda de atual
		    $to 		= $dados[2];	//Parâmetro - Moeda de desejada
		    $rate 		= $dados[3];	//Parâmetro - Taxa da moeda desejada

		    $classe 	= 'Exchange';	//Classe - Contém a função responsável pela conversão da moeda
		    $metodo 	= 'convertCoin';//Função - Convenverte a moeda
		    $parametros = array();
		    $parametros = $dados;

		    //valido os parâmetros passados pelo usuário na url
		    if (count($parametros) !== 4 || $rate == '' || $amount =='' || $from =='' || $to =='') { 

		    	return json_encode(array('Status' => 'Erro 412', 'Reason' => 'Falha de pré-condição'));
		    	exit();

		    }
		    /***********end-block*************/

		    if (class_exists($classe)) {

		    	if (method_exists($classe, $metodo)) {
		    		$retorno = call_user_func_array(array(new $classe, $metodo), array($parametros));

		    		return json_encode(array($retorno));
		    		//return json_encode($retorno, 1);
		    		
		    	}	

		    } else {

		    	return json_encode(array('Status' => 'Erro 400', 'Reason' => 'Solicitação Inválida'));
		    }




		}		
	}
	/*********************/





}
/*********************/


?>