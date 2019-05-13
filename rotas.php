<?php

//405
$container['notAllowedHandler'] = function ($c) {
    return function ($req, $res) use ($c) {
        return $response->withJson('Metodo inválido', 405);
    };
};

//404
$container['notFoundHandler'] = function ($c) {
    return function ($req, $res, $metodo) use ($c) {
        return $response->withJson('Recurso não encontrado', 404);
    };
};

$app->get('/cotacao/{de}/{para}/{valor}', Controller\Cotacao::class . ':cotar');