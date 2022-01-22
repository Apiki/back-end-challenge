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
 * @author   Yves Cabral <yvescabral16@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Http\Controllers\ExchangeController;
use App\Application;

$app = new Application();

$router = $app->getRouter();
$router->route('/exchange/{amount}/{from}/{to}/{rate}', [ExchangeController::class, 'convert']);

$app->run();
