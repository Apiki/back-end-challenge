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
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use League\Route\Http\Exception\BadRequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new \Laminas\Diactoros\ResponseFactory();

$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$router   = (new League\Route\Router)->setStrategy($strategy);

// map a route
$router->map('GET', '/exchange/{amount}/{from}/{to}/{rate}', function (ServerRequestInterface $request, $dados) : array {
    if (!is_numeric($dados['amount']) || !is_numeric($dados['rate']) || $dados['amount'] < 0 || $dados['rate'] < 0 || $dados['to'] === "usd"){
        throw new BadRequestException;
    }
    switch($dados['from']){
        case 'BRL':
            if($dados['to'] == 'USD' || $dados['to'] == 'EUR'){
                return [
                    "valorConvertido" => $dados['amount'] * $dados['rate'],
                    "simboloMoeda" => $dados['to'] == "USD" ? '$' : '€'
                ];
            }
        break;
        case 'USD':
            if($dados['to'] == 'BRL'){
                return [
                    "valorConvertido" => $dados['amount'] * $dados['rate'],
                    "simboloMoeda" => "R$"
                ];
            }
        break;
        case 'EUR':
            return [
                "valorConvertido" => $dados['amount'] * $dados['rate'],
                "simboloMoeda" => "R$"
            ];
        break;
        default:
            throw new BadRequestException;
        break;
    }
});

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);