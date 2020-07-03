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
declare (strict_types = 1);

require __DIR__ . '/vendor/autoload.php';
/**
 * Importar as classes
 */

include_once 'src/Router.php';
include_once 'src/Coin.php';

/**
 * Declarar as classes
 */

$router = new Router();

/**
 *Adicionar rotas
 */

$router->add('/exchange/{amount}/{from}/{to}/{rate}', 'Coin@convert');

/**
 * Executar requisição
 */
$request_uri = $_SERVER['REQUEST_URI'];

$router->get($request_uri);
