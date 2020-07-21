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

    declare (strict_types=1);
    require 'class/Router.php';

    require __DIR__ . '/vendor/autoload.php';

    //Validação de erros de requisição na url
    $parametros = explode('/', $_SERVER['REQUEST_URI']);
    
    if (count($parametros) <6) { echo retornarErro(400); return null;  }

    Route::add('/',function() { echo retornarErro(400); return null; });
    Route::add('/exchange',function() { echo retornarErro(400); return null; });
    Route::add('/exchange/([0-9.-]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9.-]+)/', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9.-]+)/([A-Z]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9.-]+)/([A-Z]+)/([A-Z]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([a-z])/([A-Z]+)/([A-Z]+)/([0-9.]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9.]+)/([A-Z]+)/([A-Z]+)/([a-z])', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/(-[0-9]+)/([A-Z]+)/([A-Z]+)/([0-9.]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9.]+)/([A-Z]+)/([A-Z]+)/(-[0-9.]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9]+)/([a-z]+)/([A-Z]+)/([0-9.]+)', function() { echo retornarErro(400); return null; }, 'get');
    Route::add('/exchange/([0-9]+)/([A-Z]+)/([a-z]+)/([0-9.]+)', function() { echo retornarErro(400); return null; }, 'get');  
    /***final da validação***/

    /***se todas as condições forem satisfeitas***/
    Route::add('/exchange/([0-9.]+)/([A-Z]+)/([A-Z]+)/([0-9.]+)', function($amount, $from, $to, $rate) {
    
    $simboloMoeda=array('BRL' => 'R$', 'USD' => '$', 'EUR' => '€');
    $amount=str_replace(',', '.',  $amount);
    $rate=str_replace(',', '.',  $rate);
 
    $valorConvertido = round($amount * $rate,2) ;                    

    $resultado = json_encode(['valorConvertido' => $valorConvertido, 'simboloMoeda' => $simboloMoeda[$to]]);
    echo($resultado);
    
}, 'get');

Route::run('/');