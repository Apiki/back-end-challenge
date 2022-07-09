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
 * @author   Seu Nome <seu-email@seu-provedor.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$config = ['settings' => ['displayErrorDetails' => true]];
$container = new \Slim\Container($config);
$app = new \Slim\App($container);

$app->get('/', '\App\Controllers\Exchange:init');
$app->get('/exchange/', '\App\Controllers\Exchange:init');
$app->get('/exchange[/{amount:[A-Za-z0-9.-]+}[/{from}[/{to}[/{rate:[A-Za-z0-9.-]+}]]]]', '\App\Controllers\Exchange:init');
$app->run();
