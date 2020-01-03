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
    require 'app/classes/MoedaFactory.php';
    require 'app/classes/Validator.php';


    $router = new Router();

    $router->get('exchange/{qtd}/{moeda_origem}/{moeda_destino}/{cotacao}', function($qtd, $moeda_origem, $moeda_destino, $cotacao){


        //Realiza-se as validações unitárias básicas
        $validator = new Validator();

        if (!$validator->validaString('Moeda de Origem',$moeda_origem, 3,3,"EUR,USD,BRL"))
            Router::makeResponse('Formato de entrada Inválido', 400);

        if (!$validator->validaString('Moeda de  Destino',$moeda_destino, 3,3,'EUR,USD,BRL'))
            Router::makeResponse('Formato de entrada Inválido', 400);

        if (!$validator->validaFloat('Quantidade',$qtd, 0.01 ))
            Router::makeResponse('Formato de entrada Inválido', 400);

        if (!$validator->validaFloat('Cotação Atual',$cotacao, 0.01, null, false ))
            Router::makeResponse('Formato de entrada Inválido', 400);



        //Realiza-se o cálculo simples abaixo
        $valor_total = (float)$qtd * (float)$cotacao;

        //Cria-se uma instância da moeda de destino, através de uma Factory (Padrão de Projeto Factory)
        $obj_moeda_destino = MoedaFactory::getMoeda($moeda_destino);


        //Cria-se a resposta status 200 - JSON
        $response = [
            'valorConvertido' => $valor_total,
            'simboloMoeda' => $obj_moeda_destino->getSimbolo()
        ];

        Router::makeResponse($response, 200);

    });




