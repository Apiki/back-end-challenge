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
    require 'class/Router.php';

    require __DIR__ . '/vendor/autoload.php';

    //Validação de erros de requisição na url
    Route::add('/',function()   { echo retornarErro(400); });
    Route::add('/exchange',function()   { echo retornarErro(400); });
    Route::add('/exchange/([0-9.-]+)', function() { echo retornarErro(400); }, 'get');

    Route::add('/exchange/([0-9.-]+)/([A-Z]+)', function() { echo retornarErro(400); }, 'get');
    Route::add('/exchange/([0-9.-]+)/([A-Z]+)/([A-Z]+)', function() { echo retornarErro(400); }, 'get');
    Route::add('/exchange/([a-z])/([A-Z]+)/([A-Z]+)/([0-9.]+)', function()      { echo retornarErro(400); }, 'get');
    Route::add('/exchange/([0-9.]+)/([A-Z]+)/([A-Z]+)/([a-z])', function()      { echo retornarErro(400); }, 'get');
    Route::add('/exchange/(-[0-9]+)/([A-Z]+)/([A-Z]+)/([0-9.]+)', function()    { echo retornarErro(400); }, 'get');
    Route::add('/exchange/([0-9.]+)/([A-Z]+)/([A-Z]+)/(-[0-9.]+)', function()   { echo retornarErro(400); }, 'get');
    Route::add('/exchange/([0-9]+)/([a-z]+)/([A-Z]+)/([0-9.]+)', function()     { echo retornarErro(400); }, 'get');
    Route::add('/exchange/([0-9]+)/([A-Z]+)/([a-z]+)/([0-9.]+)', function()     { echo retornarErro(400); }, 'get');  
    /***final da validação***/  

    Route::add('/exchange/([0-9.]+)/([A-Z]+)/([A-Z]+)/([0-9.]+)', function($amount, $from, $to, $rate) {
    
    $simboloMoeda    = array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');
    $amount          = str_replace(',', '.',  $amount);
    $rate            = str_replace(',', '.',  $rate);
 
    $valorConvertido = round($amount * $rate,2) ;                    
    $resultado       = array("valorConvertido"=>$valorConvertido,"simboloMoeda"=>$simboloMoeda);

    $retorno = json_encode(['valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda[$to]]);
    echo($retorno);
    
}, 'get');

Route::run('/');


function retornarErro($code)
{

    header_remove();

    http_response_code($code);

    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");

    header('Content-Type: application/json');

    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );

    header("HTTP/1.1 ".$status[$code]);
    
    $json_response = json_encode($status[$code], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo $json_response;
}