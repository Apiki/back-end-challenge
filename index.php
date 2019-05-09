<?php

require_once (__DIR__.'/Helper.php');

/* Recebendo valores da requisição e montando array $param */
$param = explode('/', $_SERVER['PATH_INFO']);
unset($param[0]);
$param = array_values($param);

/* Armazenando valores da requisição */ 
$amount = $param[0];
$from = strtoupper($param[1]);
$to = strtoupper($param[2]);
$rate = $param[3];

/* Pegando símbolo da moeda */
$currencySymbol = Helper::getCurrencySymbol($to);
/* Calculo do novo valor convertido */
$newAmount = Helper::getNewAmount($amount, $rate);
/* Tratando algumas validações */
$rules = Helper::getRules($amount, $from, $to, $rate);

if (isset($rules)) {
    echo $rules;
} else {
    /* Array resposta */
    $resposta = [
        "valorConvertido" => number_format($newAmount, 2),
        "simboloMoeda" => $currencySymbol
    ];
    /* Print como array em PHP */
    print_r($resposta);
    /* Resposta em formato JSON, porém não reconhece o símbolo do Euro */
    //echo json_encode($resposta);
}


?>