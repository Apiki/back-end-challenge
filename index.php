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
 * @author   João Victor <jv.duarte.viana@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=0);

require __DIR__ . '/vendor/autoload.php';

use App\Controller\CoinController;
use Slim\Factory\AppFactory;

function failRouter($response){
    $response->getBody()->write(json_encode(['error'=> 'error' ]));
    return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(400);

}

$routers = AppFactory::create();
$routers->get('/exchange/{amount}/{from}/{to}/{rate}', CoinController::class . ':convertCoin');
$routers->get('/exchange/{amount}/{from}/{to}', function($request, $response, $args){
    return failRouter($response);
});
$routers->get('/exchange/{amount}/{from}', function($request, $response, $args){
    return failRouter($response);
});
$routers->get('/exchange/{amount}', function($request, $response, $args){
    return failRouter($response);
});
$routers->get('/exchange/', function($request, $response, $args){
    return failRouter($response);
});
$routers->run();