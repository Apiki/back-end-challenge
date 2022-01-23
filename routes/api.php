<?php

use App\Classes\Router;
use App\Controllers\ApiController;

$router = new Router();

$router->get('exchange/{amount}/{from}/{to}/{range}', function($amount, $from, $to, $range)
{
    // Chama o controller responsável pelos parâmetros da API
    ApiController::get($amount, $from, $to, $range);

//    $response = $amount;
//    Router::response($response, 200);

});