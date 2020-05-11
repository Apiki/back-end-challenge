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
 * @author   Maurício Silva <mauriciof.silva@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

use Slim\App;
use App\Helpers\ValidateEndpoint;

require __DIR__ . '/vendor/autoload.php';

$app = new App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);

$app->get('/', function ($request, $response, $args) {
    return $response->withJson(['msg' => 'Bad Request'], 400)
            ->withHeader('Content-Type', 'application/json');
});

$app->get('/exchange/{amount}/{from}/{to}/{rate}', '\App\Controllers\ExchangeController:exchange');

$app->get('/exchange/{amount}/{from}/{to}[/]', function($request, $response, $args) use ($app) {
    return ValidateEndpoint::routeHandler($response);
});
$app->get('/exchange/{amount}/{from}[/]', function($request, $response, $args) use ($app) {
    return ValidateEndpoint::routeHandler($response);
});
$app->get('/exchange/{amount}[/]', function($request, $response, $args) use ($app) {
    return ValidateEndpoint::routeHandler($response);
});
$app->get('/exchange[/]', function($request, $response, $args) use ($app) {
    return ValidateEndpoint::routeHandler($response);
});


$app->run();
