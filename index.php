<?php

require_once (__DIR__.'/Helper.php');

$method = $_SERVER['REQUEST_METHOD'];

$params = json_decode(file_get_contents('php://input'),true);

//Valida se o método enviado é do tipo POST
if($method != "POST"){
    Helper::responseMethodNotAllowed('Aceita somente o metodo POST');
}

//Valida se foi enviado algum parametro
if(empty($params)){
    Helper::responseNotAcceptable('Nenhum parametro enviado');
}

//Valida se foi enviado o parametro quote
if(is_array($params) && !array_key_exists('quote', $params)){
    Helper::responseNotAcceptable("Parametro 'quote' não encontrado");
}

if(!is_numeric($params['quote'])){
    Helper::responseNotAcceptable("Parametro 'quote' não é um número. Esperado: Float, Integer. Ex: 1000.00");
}

$response = [
    "Cotação: " . $params['quote'],
    "De Real para Dólar: " . Helper::getCurrencySimbol('usd') .' '. Helper::getCurrencyValue('brl', 'usd', $params['quote']),
    "De Dólar para Real: " . Helper::getCurrencySimbol('brl') .' '. Helper::getCurrencyValue('usd', 'brl', $params['quote']),
    "De Real para Euro: " . Helper::getCurrencySimbol('eur') .' '. Helper::getCurrencyValue('brl', 'eur', $params['quote']),
    "De Euro para Real: " . Helper::getCurrencySimbol('brl') .' '. Helper::getCurrencyValue('eur', 'brl', $params['quote']),
];

Helper::responseSuccess($response);