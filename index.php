<?php
header('Content-type: application/json; charset=utf-8');
require  __DIR__ .'/valores.php';
require __DIR__ . '/vendor/autoload.php';

$conversao = new Valores();

    
    $parametros = explode('/', $_SERVER['REQUEST_URI']);

    // Valida a quantidade de parametros

if (count($parametros) == 6) {
    $conversao->setAmount($parametros[2]);
    $conversao->setFrom($parametros[3]);
    $conversao->setTo($parametros[4]);
    $conversao->setRate($parametros[5]);

    $count = 0;
    $errvar6 = "";

    // Valida os parametros passados

    if ($conversao->validarInt($parametros[2]) === false) {
        $errvar1 =  "Quantidade a converter é inválida, nula ou menor que zero {amount}";
        $count ++;
        $errvar6 = $errvar6. " - " .$errvar1;
    }

    if ($conversao->validarMoeda($parametros[3]) === false) {
        $errvar2= "Moeda a converter diferente de (BRL,USD,EUR) {from}";
        $count ++;
        $errvar6 = $errvar6. " - " .$errvar2;
    }

    if ($conversao->validarMoeda($parametros[4]) === false) {
        $errvar3= "Moeda de conversão diferente de (BRL,USD,EUR) {to}";
        $count ++;
        $errvar6 = $errvar6. " - " .$errvar3;
    }

    if ($conversao->validarInt($parametros[5]) === false) {
        $errvar4= "Taxa de conversão é inválida, nula ou menor que zero {rate}";
        $count ++;
        $errvar6 = $errvar6. " - " .$errvar4;
    }

    // Caso tenha algum parametro inválido, retorna o 400, caso não, retorna o 200
    if ($count > 0) {
        $errvar5 = "Verifique os parametros";
        $conversao->resposta(400, $errvar5, $errvar6);
             
    }

    else
    {

        $quant = $conversao->getAmount();
        $taxa = $conversao->getRate();

        $valorConvertido = ($quant * $taxa);
        $simbolo = $conversao->tpMoeda($conversao->getTo());

        
        $conversao->resposta(200, $valorConvertido, $simbolo);
    }


}
else
{
    $err1 = "Parametros Invalidos";
    $err2 = "Verifique a quantidade de argumentos {amount}/{from}/{to}/{rate}";
    $conversao->resposta(400, $err1, $err2);
}















