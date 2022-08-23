<?php
/**
 * Realiza a rotina principal da API
 * 
 * PHP version 7.4
 * 
 * @category Challenge
 * @package  Back-end
 * @author   Bernardo Gomes <bernardomgo@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/bernardomaia/back-end-challenge
 */


require 'request.php';
require 'controller.php';

$response = [];

$r = new request;

[$method, $data] = $r->getRequest();

if (isset($method)) {
    $c = new controller;
    $response = $c->procRequest('_' . $method, $data);
} else {
    $response['ERRO'] = 'MÉTODO NÃO ENCONTRADO';
}

$r->sendResponse($response);


