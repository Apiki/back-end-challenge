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
 * @author   Talles Fernando Silva
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

// Use this namespace
use Steampixel\Route;

// Require the class
require('src/Route.php');
require('src/exchange.php');

Route::add('/exchange/([0-9.'.']*)/([A-Z]*)/([A-Z]*)/([0-9.'.']*)', function($amount, $from, $to, $rate) {
 
    $exchange = new Exchange($amount,$from,$to,$rate);
    $exchange->exec();
},'get');

Route::pathNotFound(function($path) {
    response(400, "URL não válida", NULL);
});
  

Route::run('/');


require __DIR__ . '/vendor/autoload.php';