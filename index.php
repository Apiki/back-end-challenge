<?php

require_once (__DIR__.'/Helper.php');

$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', $_SERVER['REQUEST_URI']);
unset($uri[0]);
$uri = array_values($uri);

//valida a rota informada
if(empty($uri) || $uri[0] != 'exchange'){
    Helper::responseMethodNotAllowed('rota invalida');
}

//Valida se foi informado o parametro amount na url
if(!isset($uri[1])){
    Helper::responseMethodNotAllowed('Valor não informado');
}

//valida se amount é numérico
$amount = $uri[1];
if(!is_numeric($amount)){
    Helper::responseMethodNotAllowed('Valor para converter não é numérico');
}

//valida se amount é maior que zero
if($amount <= 0){
    Helper::responseMethodNotAllowed('Valor deve ser maior que 0');
}

//valida se foi informado o parametro from na url
if(!isset($uri[2])){
    Helper::responseMethodNotAllowed('Moeda de entrada não informada');
}

//Seta a lista de moedas validas
$currency = Helper::$CURRENCY;

//Valida se a moeda de entrada é valida
$from = strtolower($uri[2]);
if(!in_array($from,$currency)){
    Helper::responseMethodNotAllowed('Moeda de entrada não suportada');
}

//Valida se foi informado o parametro to na url
if(!isset($uri[3])){
    Helper::responseMethodNotAllowed('Moeda de saida não informada');
}

//Valida se a moeda de saida é valida
$to = strtolower($uri[3]);
if(!in_array($to,$currency)){
    Helper::responseMethodNotAllowed('Moeda de saida não suportada');
}

//Valida se foi informado o parametro amount na url
if(!isset($uri[4])){
    Helper::responseMethodNotAllowed('Taxa de conversão não informado');
}

$rate = $uri[4];
if(!is_numeric($amount)){
    Helper::responseMethodNotAllowed('Taxa de conversão não é numérico');
}

//valida se amount é maior que zero
if($rate <= 0){
    Helper::responseMethodNotAllowed('Taxa de conversão deve ser maior que 0');
}

if(Helper::invalidExchange($from, $to)){
    Helper::responseMethodNotAllowed('Conversão não disponível');
}

$response =[
    "valorConvertido" => $amount/$rate,
    "simboloMoeda" => Helper::getCurrencySimbol($to)
];

Helper::responseSuccess($response);