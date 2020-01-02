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

    require __DIR__ . '/vendor/autoload.php';

    require 'app/classes/Router.php';
    require 'app/classes/Currency.php';

    echo "Erro Aqui";


    $router = new Router();

    $router->get('exchange/{qtd}/{moeda_origem}/{moeda_destino}/{cotacao}', function($qtd, $moeda_origem, $moeda_destino, $cotacao){

        echo ("$qtd $moeda_origem $moeda_destino $cotacao")."<br>";

        $obj_moeda_origem = Currency::factory($moeda_origem);
        $obj_moeda_destino = Currency::factory($moeda_destino);



        echo $obj_moeda_origem->getSimbolo()." - ".$obj_moeda_destino->getSimbolo();


    });




