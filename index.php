<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.1.6
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Kauê Leal de Lima <kaueslim@outlook.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

use App\Common\Router;
use App\Controllers\{HomeController, ErrorController, ConvertMoneyController};

require __DIR__ . '/vendor/autoload.php';

$router = new Router();
$router->get("/", HomeController::class);
$router->get("/error/{code}", ErrorController::class);
$router->get("/exchange/{amount}/{from}/{to}/{rate}", ConvertMoneyController::class);

$router->run();

if ($router->error()) {
    redirect("error/{$router->error()}");
}
