<?php
/**
 * Arquivo onde faz a chamada da Api.
 * Forma de utilização: http://localhost/BRL/1.00/3.00/USD/json -- http://endereco/moedaDe/valor/valorCotacao/moedaPara/tipoRetorno
 * Tipo de Retorno: json ou csv.
 * Obs: A passagem de parametros é pela url.
 * Nome: Guilherme Henrique Ribeiro Costa.
 */
include_once('UrlUtil.php');
include_once('WebApiUtil.php');
$url = new UrlUtil();
$api = new WebApiUtil();
try {
    $parametros = $url->getParametros($_SERVER['REQUEST_URI']);
    $api->processConversao($parametros->moedaDe, $parametros->moedaPara, $parametros->valorCotacao, $parametros->valor, $parametros->tipo);
} catch (Exception $exception) {
    echo $exception->getMessage();
}

