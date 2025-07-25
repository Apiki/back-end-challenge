<?php
/**
 * Back-end Challenge.
 *
 * PHP version 8.3
 *
 * Este será o arquivo chamado na execução dos testes automátizados.
 *
 * @category Challenge
 * @package  Back-end
 * @author   Lucas Sens <lucassousase@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\ExchangeController;

$controller = new ExchangeController();
$controller->handleRequest();

