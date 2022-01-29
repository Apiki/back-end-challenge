<?php

use PlugRoute\RouteFactory;

$router = RouteFactory::create();

/** Rota de Conversão de moedas - Aderente ao exemplo usado no README.md */
$router
    ->get('/exchange/{amount}/{from}/{to}/{rate}', 'App\\controllers\\ExchangeController@conversion')
    ->middleware(['App\\middlewares\ParamsMiddleware']);

/** Rota de Conversão de moedas - Aderente ao que é usado nos tests, sem o exchange na rota. */
$router
    ->get('/{amount}/{from}/{to}/{rate}', 'App\\controllers\\ExchangeController@conversion')
    ->middleware(['App\\middlewares\ParamsMiddleware']);

/** Denais rotas */
$router->get('{anything}', 'App\\controllers\\DefaultController@defaultRoute');

$router->on();
