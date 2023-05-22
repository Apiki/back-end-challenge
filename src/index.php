<?php
/**
 * Back-end Challenge.
 *
 * PHP version 7.4
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
define( 'ROOT_DIR', __DIR__ );
require __DIR__ . '/../vendor/autoload.php';


/**
 * A ideia aqui é fazer um FrontController, mesmo que estejamos somente
 * com um endpoint, fiz imaginando uma estrutura que poderia crescer
 */
require_once ROOT_DIR . '/inc/helpers.php';
require_once ROOT_DIR . '/inc/Router/Router.php';
require_once ROOT_DIR . '/inc/Controllers/ExchangeController.php';
$routes = new Router();

// Rota para /exchange/{amount}/{from}/{to}/{rate}
$routes->add('/exchange/{amount}/{from}/{to}/{rate}', ['GET'], [ExchangeController::class, 'handleRequest']);

$routes->handleRequest();