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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

//require __DIR__ . '/vendor/autoload.php';

include('class/Route.php');

Route::add('/',function(){
    echo '<h1>Apki API Exchange</h1>';
    echo '<h3>usage: http://localhost:8000/exchange/{amount}/{from}/{to}/{rate}</h3>';
});

Route::add('/exchange/([0-9.-]+)/([A-Z]+)/([A-Z]+)/([0-9.-]+)', function($amount, $from, $to, $rate) {
    $moedas = [
                'BRL' => 'R$',
                'USD' => '$',
                'EUR' => '€'
            ];
    $result = $amount * $rate;
    $json = [
            'valorConvertido' => $result,
            'simboloMoeda'    => $moedas[$to]
        ];
    $data = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $data;
}, 'get');

Route::run('/');
