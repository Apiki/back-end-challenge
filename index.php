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

    declare (strict_types = 1);
    require __DIR__ . '/vendor/autoload.php';


    require 'class/Router.php';

    Route::add('/exchange/([0-9.-]+)/([A-Z]+)/([A-Z]+)/([0-9.-]+)', function($amount, $from, $to, $rate) {
    
    $simboloMoeda    = array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');
    $amount          = str_replace(',', '.',  $amount);
    $rate            = str_replace(',', '.',  $rate);
 
    $valorConvertido = round($amount * $rate,2) ;                    
    $resultado       = array("valorConvertido"=>$valorConvertido,"simboloMoeda"=>$simboloMoeda);
        
    $resultado  = ['valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda[$to]];
 
    $retorno = json_encode($resultado);
    echo($retorno);
    
}, 'get');

Route::run('/');
