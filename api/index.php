<?php
namespace api;

require_once "converte.php";

header('Content-type: application/json');

/**
*	Verifica se as variáveis foram declaradas
*	@valor float
*	@moedaorigem string
*	@moedadestino string
*/
if(isset($_GET['valor'], $_GET['moedaorigem'], $_GET['moedadestino'])) {
    $valor = floatval($_GET['valor']);
    $moedaOrigem = $_GET['moedaorigem'];
    $moedaDestino = $_GET['moedadestino'];
    
    $converte = new Converte;
    $converte->converteValor($valor, $moedaOrigem, $moedaDestino);
    
    //$converte = new Converte($_GET['valor'],$_GET['moedaDestino'],$_GET['moedaOrigem']);
} else {
    echo json_encode([
    	"Error" 		=> "Falta especificar os parametros",
    	"valor" 		=> "float", 
    	"moedaorigem" 	=> ['brl', 'usd', 'eur'],
    	"moedadestino" 	=> ['brl', 'usd', 'eur']
    	]);
}