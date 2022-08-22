<?php

/**
 * Back-end Challenge.
 *
 * PHP version 7.4
 *
 * Este será o arquivo chamado na execução dos testes automatizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Bernardo Gomes <bernardomgo@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/controller.php';

$response = [];
$request = array_filter(explode('/', $_SERVER['REQUEST_URI']));
$method = array_shift($request);


if (isset($method)) {
    $c = new controller;
    $response = $c->procRequest('_' . $method, $request);
} else {
    $response['ERRO'] = 'MÉTODO NÃO ENCONTRADO';
}

send_response($response);
//
function send_response($response)
{
    header("Content-Type:application/json");
    if (!$response) { 
        $response['ERRO'] = 'OPERAÇÃO NÃO RECONHECIDA';
    }
    if (isset($response['ERRO'])) {
        http_response_code(400);
    }
    echo json_encode($response);
}
