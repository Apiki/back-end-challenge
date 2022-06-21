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

require __DIR__ . '/vendor/autoload.php';

require __DIR__ . "/Src/Controllers/Web.php";


use CoffeeCode\Router\Router;


define("URL_BASE", "http:localhost:8000/exchange");

$router = new Router(URL_BASE);

$router->namespace("App\Controllers");

$router->get("/{amount}/{from}/{to}/{rate}", "Web:convert");




$router->group("oops");
$router->get("/{errcode}", "Web:error");


$router->dispatch();


if($router->error()){
    $router->redirect("/oops/{$router->error()}");
}