<?php

require_once __DIR__ . '/../vendor/autoload.php';

$configuracoes = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,
]];

$container = new \Slim\Container($configuracoes);

$app = new \Slim\App($container);

require_once __DIR__ . '/../rotas.php';

$app->run();