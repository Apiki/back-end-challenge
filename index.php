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
 * @author   Rodrigo Z Gaspar <rodgasp@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @link     https://github.com/apiki/back-end-challenge
 */
declare(strict_types=1);

$_SERVER['SCRIPT_NAME'] = pathinfo(__FILE__, PATHINFO_BASENAME);

require __DIR__ . '/vendor/autoload.php';

include __DIR__ . "/src/exchange.php";

$exchange = new Exchange();
$exchange->Run(); 