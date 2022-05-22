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

use App\Controller\ExchangeController;
use App\Kernel\Http\Request;
use App\Kernel\Kernel;

$request = new Request($_SERVER['REQUEST_URI']);
$kernel = new Kernel([
    ExchangeController::class
], $request);

$response = $kernel->execute();
$response->send();
