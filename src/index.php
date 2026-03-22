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
 * @author   João Paulin <ppaulin23@hotmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/joaopaulin/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Routers\Router;

$router = new Router();
$router->handleRequest();

